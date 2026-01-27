 <script>
/* =========================
   VARIABLES
========================= */
const audio = document.getElementById("loveSound");
const volumeSlider = document.getElementById("volume");

const FADE_IN = 3;   // secondes
const FADE_OUT = 7; // secondes

let fadeInterval = null;

/* =========================
   FADE IN
========================= */
function fadeIn() {
  clearInterval(fadeInterval);

  audio.currentTime = 0;
  audio.volume = 0;
  audio.play(); // déclenché par clic => autorisé

  const target = volumeSlider.value;
  const step = target / (FADE_IN * 20);

  fadeInterval = setInterval(() => {
    if (audio.volume < target) {
      audio.volume = Math.min(audio.volume + step, target);
    } else {
      clearInterval(fadeInterval);
    }
  }, 50);
}

/* =========================
   FADE OUT
========================= */
function fadeOut(duration) {
  clearInterval(fadeInterval);

  const step = audio.volume / (duration * 20);

  fadeInterval = setInterval(() => {
    if (audio.volume > 0) {
      audio.volume = Math.max(audio.volume - step, 0);
    } else {
      audio.pause();
      clearInterval(fadeInterval);
    }
  }, 50);
}

/* =========================
   FIN NATURELLE
========================= */
audio.addEventListener("timeupdate", () => {
  if (!audio.duration) return;

  const remaining = audio.duration - audio.currentTime;

  if (remaining <= FADE_OUT && audio.volume > 0) {
    fadeOut(remaining);
  }
});

/* =========================
   BOUTON LOVE
========================= */
function toggleLove() {
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
}

/* =========================
   VOLUME LIVE
========================= */
function setVolume(value) {
  audio.volume = value;
}

/* =========================
   MESSAGE SECRET
========================= */
document.getElementById("secretBtn").addEventListener("click", function () {
  const password = prompt("🔒 Entre le mot de passe pour voir le message secret :");

  if (password === "Kirby01082009Duck") {
    document.getElementById("secretContent").classList.remove("hidden");
    this.style.display = "none";
  } else if (password !== null) {
    alert("❌ Mot de passe incorrect !");
  }
});
</script>
