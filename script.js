 document.addEventListener("DOMContentLoaded", () => {

  const audio = document.getElementById("loveSound");
  const volumeSlider = document.getElementById("volume");

  const FADE_IN = 3;
  const FADE_OUT = 7;

  let fadeInterval = null;
  let isFadingOut = false;

  function fadeIn() {
    clearInterval(fadeInterval);
    isFadingOut = false;

    audio.currentTime = 0;
    audio.volume = 0;
    audio.play();

    const target = parseFloat(volumeSlider.value);
    const step = target / (FADE_IN * 20);

    fadeInterval = setInterval(() => {
      if (audio.volume < target) {
        audio.volume = Math.min(audio.volume + step, target);
      } else {
        clearInterval(fadeInterval);
      }
    }, 50);
  }

  function fadeOut(duration) {
    if (isFadingOut) return;
    isFadingOut = true;

    clearInterval(fadeInterval);
    const step = audio.volume / (duration * 20);

    fadeInterval = setInterval(() => {
      if (audio.volume > 0) {
        audio.volume = Math.max(audio.volume - step, 0);
      } else {
        audio.pause();
        clearInterval(fadeInterval);
        isFadingOut = false;
      }
    }, 50);
  }

  audio.addEventListener("timeupdate", () => {
    if (!audio.duration) return;

    const remaining = audio.duration - audio.currentTime;
    if (remaining <= FADE_OUT && audio.volume > 0) {
      fadeOut(remaining);
    }
  });

  window.toggleLove = function () {
    const surprise = document.getElementById("surprise");
    const button = document.getElementById("loveBtn");

    if (surprise.classList.contains("hidden")) {
      surprise.classList.remove("hidden");
      button.textContent = "Hide the love 💙";
      fadeIn();
    } else {
      surprise.classList.add("hidden");
      button.textContent = "Click here 💖";
      fadeOut(FADE_OUT);
    }
  };

  window.setVolume = function (value) {
    audio.volume = value;
  };

  document.getElementById("secretBtn").addEventListener("click", function () {
    const password = prompt("🔒 Enter the password to see the secret message :");

    if (password === "Kirby01082009Duck") {
      document.getElementById("secretContent").classList.remove("hidden");
      this.style.display = "none";
    } else if (password !== null) {
      alert("❌ Password incorrect !");
    }
  });

});
