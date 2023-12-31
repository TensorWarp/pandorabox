"use strict";

const audioElements = document.querySelectorAll('.my-audio');
const playPauseButtons = document.querySelectorAll('.playPauseButton');
let currentSpeechAudio = null;
playPauseButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    const audio = audioElements[index];
    if (audio.paused) {
      if (currentSpeechAudio && currentSpeechAudio !== audio) {
        currentSpeechAudio.pause();
        const currentIndex = Array.from(audioElements).indexOf(currentSpeechAudio);
        playPauseButtons[currentIndex].innerHTML = '<svg class="w-3 h-3 text-color-14 dark:text-white bg-[#F1F3F4] dark:bg-[#474746]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 8 8" version="1.1"><title>play [#1001]</title> <desc>Created with Sketch.</desc><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Dribbble-Light-Preview" transform="translate(-427.000000, -3765.000000)" fill="currentColor"><g id="icons" transform="translate(56.000000, 160.000000)"><polygon id="play-[#1001]" points="371 3605 371 3613 378 3609"></polygon></g></g></g></svg>';
      }
      audio.play();
      button.innerHTML = '<svg class="w-3 h-3 text-color-14 dark:text-white bg-[#F1F3F4] dark:bg-[#474746]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" version="1.1" id="Capa_1" width="800px" height="800px" viewBox="0 0 277.338 277.338" xml:space="preserve"><g><path d="M14.22,45.665v186.013c0,25.223,16.711,45.66,37.327,45.66c20.618,0,37.339-20.438,37.339-45.66V45.665   c0-25.211-16.721-45.657-37.339-45.657C30.931,0,14.22,20.454,14.22,45.665z"/><path d="M225.78,0c-20.614,0-37.325,20.446-37.325,45.657V231.67c0,25.223,16.711,45.652,37.325,45.652s37.338-20.43,37.338-45.652   V45.665C263.109,20.454,246.394,0,225.78,0z"/></g></svg>';
      currentSpeechAudio = audio;
    } else {
      audio.pause();
      button.innerHTML = '<svg class="w-3 h-3 text-color-14 dark:text-white bg-[#F1F3F4] dark:bg-[#474746]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 8 8" version="1.1"><title>play [#1001]</title> <desc>Created with Sketch.</desc><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Dribbble-Light-Preview" transform="translate(-427.000000, -3765.000000)" fill="currentColor"><g id="icons" transform="translate(56.000000, 160.000000)"><polygon id="play-[#1001]" points="371 3605 371 3613 378 3609"></polygon></g></g></g></svg>';
      currentSpeechAudio = null;
    }
  });
});
audioElements.forEach((audio, index) => {
  audio.addEventListener('ended', () => {
    playPauseButtons[index].innerHTML = '<svg class="w-3 h-3 text-color-14 dark:text-white bg-[#F1F3F4] dark:bg-[#474746]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 8 8" version="1.1"><title>play [#1001]</title> <desc>Created with Sketch.</desc><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Dribbble-Light-Preview" transform="translate(-427.000000, -3765.000000)" fill="currentColor"><g id="icons" transform="translate(56.000000, 160.000000)"><polygon id="play-[#1001]" points="371 3605 371 3613 378 3609"></polygon></g></g></g></svg>';
    currentSpeechAudio = null;
  });
});
