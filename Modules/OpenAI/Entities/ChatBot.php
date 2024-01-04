<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use Modules\MediaManager\Http\Models\ObjectFile;

class ChatBot extends Model
{
    use hasFiles;
    use ModelTrait;
    protected $table = 'chat_bots';

    protected $with = ['chatCategory'];

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = [
        'chat_category_id',
        'name',
        'code',
        'message',
        'role',
        'promt',
        'status',
        'is_default'
    ];

    /**
     * Store Chat Bot
     *
     * @param array $data
     * @return bool
     */
    public function store($data) {

        if ($data['is_default'] === "1") {
            parent::where('is_default', 1)->update(['is_default' => 0]);
        }

        if (parent::insert($data)) {
            $fileIds = [];
            if (request()->has('file_id')) {
                foreach (request()->file_id as $data) {
                    $fileIds[] = $data;
                }
            }
            ObjectFile::storeInObjectFiles($this->objectType(), $this->objectId(), $fileIds);

            return true;
        }

        return false;
    }


    /**
     * Update
     * @param array $data
     * @param int $id
     * @return array|boolean
     */
    public function updateBot($data = [], $id = null)
    {
        $result = $this->where('id', $id);
        if ($result->exists()) {
            if ($data['is_default'] === "1") {
                parent::where('is_default', 1)->update(['is_default' => 0]);
            }
            if ($result->update($data)) {

                if (request()->file_id) {
                    $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
                    return true;
                } else {
                    return $result->first()->deleteFromMediaManager();
                }
            }
        }

        return false;
    }

    /**
     * Relation with Chat Category Model
     */
    public function chatCategory()
    {
        return $this->belongsTo(ChatCategory::class, 'chat_category_id');
    }

     /**
     * Relation with ContentTypes model
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class, 'bot_id');
    }
}
