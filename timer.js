// grab the elements
const time = document.getElementById("time-display");
const workBtn = document.getElementById("work-btn");
const breakBtn = document.getElementById("break-btn");
const longbreakBtn = document.getElementById("longbreak-btn");
const startpauseBtn = document.getElementById("startpause-btn");
const skipBtn = document.getElementById("skip-btn");

// timer states; to be changed later
let timerDuration = 0;
let timerInterval = null;
let isRunning = false;

// timer state and changing it
const STATES = {
  WORK: "work",
  BREAK: "break",
  LONG_BREAK: "long-break"
};

workBtn.addEventListener("click", () => {
    currentState = STATES.WORK;
    timerDuration = 25 * 60;
    updateDisplay();
});

breakBtn.addEventListener("click", () => {
    currentState = STATES.BREAK;
    timerDuration = 5 * 60;
    updateDisplay();
});

longbreakBtn.addEventListener("click", () => {
    currentState = STATES.LONG_BREAK;
    timerDuration = 15 * 60;
    updateDisplay();
});



// function to format time
function formatTime(seconds) {
    const m = Math.floor(seconds/60);
    const s = seconds % 60;
    return `${String(m).padStart(2, "0")}:${String(s).padStart(2, "0")}`;
}

// button actions
startpauseBtn.addEventListener("click", () => {
    if (isRunning) { // checks for a reclick cuz if u reclick it again it's gonna be true
        isRunning = false;
        clearInterval(timerInterval);
    } else {
        isRunning = true;
        timerInterval = setInterval(() => {
            if (timerDuration > 0) {
                --timerDuration;
                updateDisplay(timerDuration);
            } else {
                clearInterval(timerInterval);
                isRunning = false;
                
            }
            
        }, 1000);
    }
});

// timer display
function updateDisplay() {
    time.textContent = formatTime(timerDuration);
}

