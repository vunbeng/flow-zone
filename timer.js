// grab the elements
const time = document.getElementById("time-display");
const workBtn = document.getElementById("work-btn");
const breakBtn = document.getElementById("break-btn");
const longbreakBtn = document.getElementById("longbreak-btn");
const startpauseBtn = document.getElementById("startpause-btn");
const skipBtn = document.getElementById("skip-btn");

// timer states; to be changed later
let timerDuration = 25 * 60;
let timerInterval = null;
let isRunning = false;

// function to format time
function formatTime(seconds) {
    const m = Math.floor(seconds/60);
    const s = seconds % 60;
    return `${String(m).padStart(2, "0")}:${String(s).padStart(2, "0")}`;
}

console.log(formatTime(60))

// button actions
startpauseBtn.addEventListener("click", () => {
    if (isRunning) {
        isRunning = false;
    } else {
        isRunning = true;
        timerInterval = setInterval(() => {
            if (timerDuration > 0) {
                --timerDuration;
                updateDisplay(timerDuration);
            } else {
                isRunning = false;
                timerDuration = 0;
                updateDisplay(timerDuration);
            }
            
        }, 1000);
    }
});

// timer display
function updateDisplay() {
    time.textContent = formatTime(timerDuration);
}

