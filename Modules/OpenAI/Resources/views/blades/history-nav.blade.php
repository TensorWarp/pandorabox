<div class="mt-1.5 border-b dark:border-[#474746] dark:bg-[#292929] bg-white 9xl:px-[185px] 7xl:px-[140px] px-5 pt-[74px] pb-[19px]">
    <p class="text-color-14 dark:text-white text-24 font-RedHat font-semibold">{{ __('List of generated histories') }}</p>
</div>

@php
    if (auth()->user()->role()->type == 'admin') {
        $adminTemplateAccess = true;
        $adminSpeechToTextAccess = true;
        $adminCodeAccess = true;
        $adminTextToSpeechAccess = true;
    } else {
        $adminTemplateAccess = json_decode(preference('user_permission'))?->hide_template != 1 ? true : false;
        $adminSpeechToTextAccess = json_decode(preference('user_permission'))?->hide_speech_to_text != 1 ? true : false;
        $adminCodeAccess = json_decode(preference('user_permission'))?->hide_code != 1 ? true : false;
        $adminTextToSpeechAccess = json_decode(preference('user_permission'))?->hide_text_to_speech != 1 ? true : false;
    }
    $currcentPackage = session()->get('memberPackageData');
    if (isset($currcentPackage)) {
        $sessionUserId = $currcentPackage['packageUser'];
    } else {
        $sessionUserId = auth()->user()->id;
    }
@endphp
<div class="border-b dark:border-[#474746] dark:bg-[#292929] bg-white 9xl:px-[185px] 7xl:px-[140px] sm:px-5 whitespace-nowrap w-full ">
    <div class="flex">
        @if($adminTemplateAccess && customerPanelAccess('template') || isset($currcentPackage))
            <a href="{{ route('user.documents') }}">
                <div class="relative {{ $menu == 'document' ? 'active-border text-color-14 dark:text-white' : 'text-color-89' }} flex gap-2.5 items-center px-5 py-[14px]">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_11261_6671)">
                        <path d="M10.0461 0.900391H4.83594C3.74863 0.900391 2.86719 1.78183 2.86719 2.86914V14.6816C2.86719 15.769 3.74863 16.6504 4.83594 16.6504H12.7109C13.7982 16.6504 14.6797 15.769 14.6797 14.6816V5.53395C14.6797 5.27288 14.576 5.0225 14.3914 4.83789L10.7422 1.18871C10.5576 1.0041 10.3072 0.900391 10.0461 0.900391ZM10.25 4.3457V2.37695L13.2031 5.33008H11.2344C10.6907 5.33008 10.25 4.88936 10.25 4.3457ZM5.32812 9.75977C5.0563 9.75977 4.83594 9.53941 4.83594 9.26758C4.83594 8.99575 5.0563 8.77539 5.32812 8.77539H12.2188C12.4906 8.77539 12.7109 8.99575 12.7109 9.26758C12.7109 9.53941 12.4906 9.75977 12.2188 9.75977H5.32812ZM4.83594 11.2363C4.83594 10.9645 5.0563 10.7441 5.32812 10.7441H12.2188C12.4906 10.7441 12.7109 10.9645 12.7109 11.2363C12.7109 11.5082 12.4906 11.7285 12.2188 11.7285H5.32812C5.0563 11.7285 4.83594 11.5082 4.83594 11.2363ZM5.32812 13.6973C5.0563 13.6973 4.83594 13.4769 4.83594 13.2051C4.83594 12.9333 5.0563 12.7129 5.32812 12.7129H9.26562C9.53745 12.7129 9.75781 12.9333 9.75781 13.2051C9.75781 13.4769 9.53745 13.6973 9.26562 13.6973H5.32812Z" fill="currentColor"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_11261_6671">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                        
                    <p class="text-color-14 dark:text-white text-15 font-FigTree font-medium">{{ __('Document') }}</p>
                </div>
            </a>
        @endif
        
        @if( ($adminCodeAccess && customerPanelAccess('code')) || isset($currcentPackage))
            <a href="{{ route('user.codeList') }}">
                <div class="relative {{ $menu == 'codes' ? 'active-border text-color-14 dark:text-white' : 'text-color-89' }} flex gap-2.5 items-center px-5 py-[14px]">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.8125 4.5H14.625L11.25 1.125V3.9375C11.25 4.08668 11.3093 4.22976 11.4148 4.33525C11.5202 4.44074 11.6633 4.5 11.8125 4.5Z" fill="#898989"/>
                        <path d="M10.125 3.9375V1.125H4.5C4.20163 1.125 3.91548 1.24353 3.7045 1.4545C3.49353 1.66548 3.375 1.95163 3.375 2.25V15.75C3.375 16.0484 3.49353 16.3345 3.7045 16.5455C3.91548 16.7565 4.20163 16.875 4.5 16.875H13.5C13.7984 16.875 14.0845 16.7565 14.2955 16.5455C14.5065 16.3345 14.625 16.0484 14.625 15.75V5.625H11.8125C11.3649 5.625 10.9357 5.44721 10.6193 5.13074C10.3028 4.81428 10.125 4.38505 10.125 3.9375ZM7.14937 11.4131C7.2021 11.4654 7.24394 11.5276 7.2725 11.5962C7.30106 11.6647 7.31576 11.7382 7.31576 11.8125C7.31576 11.8868 7.30106 11.9603 7.2725 12.0288C7.24394 12.0974 7.2021 12.1596 7.14937 12.2119C7.09708 12.2646 7.03487 12.3064 6.96632 12.335C6.89778 12.3636 6.82426 12.3783 6.75 12.3783C6.67574 12.3783 6.60222 12.3636 6.53368 12.335C6.46513 12.3064 6.40292 12.2646 6.35063 12.2119L5.22563 11.0869C5.1729 11.0346 5.13106 10.9724 5.1025 10.9038C5.07394 10.8353 5.05924 10.7618 5.05924 10.6875C5.05924 10.6132 5.07394 10.5397 5.1025 10.4712C5.13106 10.4026 5.1729 10.3404 5.22563 10.2881L6.35063 9.16313C6.45655 9.0572 6.60021 8.9977 6.75 8.9977C6.89979 8.9977 7.04345 9.0572 7.14937 9.16313C7.2553 9.26905 7.3148 9.41271 7.3148 9.5625C7.3148 9.71229 7.2553 9.85595 7.14937 9.96187L6.41812 10.6875L7.14937 11.4131ZM10.0969 9.16313L8.97187 12.5381C8.93707 12.653 8.86643 12.7537 8.77028 12.8256C8.67414 12.8974 8.55753 12.9367 8.4375 12.9375C8.37653 12.936 8.31603 12.9265 8.2575 12.9094C8.18722 12.8859 8.12227 12.8488 8.06638 12.8001C8.0105 12.7514 7.96478 12.6922 7.93185 12.6258C7.89892 12.5595 7.87943 12.4872 7.8745 12.4133C7.86957 12.3393 7.8793 12.2652 7.90313 12.195L9.02812 8.82C9.07586 8.67828 9.17795 8.56132 9.31192 8.49486C9.44589 8.4284 9.60077 8.41789 9.7425 8.46563C9.88422 8.51336 10.0012 8.61545 10.0676 8.74942C10.1341 8.88339 10.1446 9.03827 10.0969 9.18V9.16313ZM12.7744 11.07L11.6494 12.195C11.5971 12.2477 11.5349 12.2896 11.4663 12.3181C11.3978 12.3467 11.3243 12.3614 11.25 12.3614C11.1757 12.3614 11.1022 12.3467 11.0337 12.3181C10.9651 12.2896 10.9029 12.2477 10.8506 12.195C10.7979 12.1427 10.7561 12.0805 10.7275 12.0119C10.6989 11.9434 10.6842 11.8699 10.6842 11.7956C10.6842 11.7214 10.6989 11.6478 10.7275 11.5793C10.7561 11.5108 10.7979 11.4485 10.8506 11.3962L11.5819 10.6875L10.8506 9.96187C10.7447 9.85595 10.6852 9.71229 10.6852 9.5625C10.6852 9.41271 10.7447 9.26905 10.8506 9.16313C10.9565 9.0572 11.1002 8.9977 11.25 8.9977C11.3998 8.9977 11.5435 9.0572 11.6494 9.16313L12.7744 10.2881C12.8271 10.3404 12.8689 10.4026 12.8975 10.4712C12.9261 10.5397 12.9408 10.6132 12.9408 10.6875C12.9408 10.7618 12.9261 10.8353 12.8975 10.9038C12.8689 10.9724 12.8271 11.0346 12.7744 11.0869V11.07Z" fill="currentColor"/>
                    </svg>
                    <p class="text-color-14 dark:text-white text-15 font-FigTree font-medium">{{ __('Codes') }}</p>
                </div>
            </a>
        @endif
        
        @if( ($adminSpeechToTextAccess && customerPanelAccess('speech_to_text')) || isset($currcentPackage))
            <a href="{{ route('user.speechLists') }}">
                <div class="relative {{ $menu == 'speeches' ? 'active-border text-color-14 dark:text-white' : 'text-color-89' }} flex gap-2.5 items-center px-5 py-[14px]">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.75 7.5C12.3375 7.5 11.9843 7.35625 11.6903 7.06875C11.3963 6.78125 11.2495 6.425 11.25 6V3C11.25 2.575 11.397 2.21875 11.691 1.93125C11.985 1.64375 12.338 1.5 12.75 1.5C13.175 1.5 13.5313 1.64375 13.8188 1.93125C14.1063 2.21875 14.25 2.575 14.25 3V6C14.25 6.425 14.1063 6.78125 13.8188 7.06875C13.5313 7.35625 13.175 7.5 12.75 7.5ZM3.75 16.5C3.3375 16.5 2.98425 16.353 2.69025 16.059C2.39625 15.765 2.2495 15.412 2.25 15V3C2.25 2.5875 2.397 2.23425 2.691 1.94025C2.985 1.64625 3.338 1.4995 3.75 1.5H9.75V3H3.75V15H12V13.5H13.5V15C13.5 15.4125 13.353 15.7658 13.059 16.0598C12.765 16.3538 12.412 16.5005 12 16.5H3.75ZM5.25 13.5V12H10.5V13.5H5.25ZM5.25 11.25V9.75H9V11.25H5.25ZM13.5 12H12V10.05C11.0375 9.875 10.2343 9.40925 9.59025 8.65275C8.94625 7.89625 8.6245 7.012 8.625 6H10.125C10.125 6.725 10.3813 7.34375 10.8938 7.85625C11.4063 8.36875 12.025 8.625 12.75 8.625C13.4875 8.625 14.1095 8.36875 14.616 7.85625C15.1225 7.34375 15.3755 6.725 15.375 6H16.875C16.875 7.0125 16.5563 7.897 15.9188 8.6535C15.2813 9.41 14.475 9.8755 13.5 10.05V12Z" fill="currentColor"/>
                    </svg>
                    <p class="text-color-14 dark:text-white text-15 font-FigTree font-medium">{{ __('Speech To Text') }}</p>
                </div>
            </a>
        @endif

        @if( ($adminTextToSpeechAccess && customerPanelAccess('voiceover')) || isset($currcentPackage))
            <a href="{{ route('user.textToSpeechList') }}">
                <div class="relative {{ $menu == 'voiceover' ? 'active-border text-color-14 dark:text-white' : 'text-color-89' }} flex gap-2.5 items-center px-5 py-[14px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_11169_5588)">
                        <path d="M10 2.5L10.0083 11.2917C9.51667 11.0083 8.95 10.8333 8.34167 10.8333C6.49167 10.8333 5 12.325 5 14.1667C5 16.0083 6.49167 17.5 8.34167 17.5C10.1917 17.5 11.6667 16.0083 11.6667 14.1667V5.83333H15V2.5H10ZM8.34167 15.8333C7.425 15.8333 6.675 15.0833 6.675 14.1667C6.675 13.25 7.425 12.5 8.34167 12.5C9.25833 12.5 10.0083 13.25 10.0083 14.1667C10.0083 15.0833 9.25833 15.8333 8.34167 15.8333Z" fill="currentColor"/>
                        </g>
                        <defs>
                        <linearGradient id="paint0_linear_11169_5588" x1="11.5017" y1="15.6538" x2="5.02108" y2="5.90405" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#898989"/>
                        <stop offset="1" stop-color="#898989"/>
                        </linearGradient>
                        <clipPath id="clip0_11169_5588">
                        <rect width="20" height="20" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                    <p class="text-color-14 dark:text-white text-15 font-FigTree font-medium">{{ __('Voiceover') }}</p>
                </div>
            </a>
        @endif
    </div>
</div>
