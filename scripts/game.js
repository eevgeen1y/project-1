const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');
const scoreElement = document.getElementById('score');
const speedElement = document.getElementById('speed');
const gameOverDiv = document.getElementById('gameOver');
const finalScoreElement = document.getElementById('finalScore');
const highScoreElement = document.getElementById('highScore');

let gameRunning = false;
let score = 0;
let speed = 1;
let gameSpeed = 2;
let roadOffset = 0;

const car = {
  x: canvas.width / 2 - 25,
  y: canvas.height - 120,
  width: 50,
  height: 80,
  color: '#e74c3c'
};

const obstacles = [];
const keys = {};

let animationId;
let obstacleSpawnTimer = 0;
let highScore = localStorage.getItem('highScore') || 0;

highScoreElement.textContent = highScore;

function drawRoad() {
  ctx.fillStyle = '#34495e';
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  ctx.strokeStyle = '#ecf0f1';
  ctx.lineWidth = 3;
  ctx.setLineDash([20, 20]);
  ctx.lineDashOffset = -roadOffset;

  ctx.beginPath();
  ctx.moveTo(canvas.width / 2, 0);
  ctx.lineTo(canvas.width / 2, canvas.height);
  ctx.stroke();
  ctx.setLineDash([]);

  roadOffset += gameSpeed * 2;
  if (roadOffset > 40) roadOffset = 0;
}

function drawCar() {
  ctx.fillStyle = car.color;
  ctx.fillRect(car.x, car.y, car.width, car.height);

  ctx.fillStyle = '#3498db';
  ctx.fillRect(car.x + 5, car.y + 10, 40, 20);
  ctx.fillRect(car.x + 5, car.y + 50, 40, 20);

  ctx.fillStyle = '#2c3e50';
  ctx.fillRect(car.x + 15, car.y - 5, 20, 10);
}

function drawObstacle(obstacle) {
  ctx.fillStyle = obstacle.color;
  ctx.fillRect(obstacle.x, obstacle.y, obstacle.width, obstacle.height);

  ctx.fillStyle = '#2c3e50';
  ctx.fillRect(obstacle.x + 5, obstacle.y + 5, obstacle.width - 10, obstacle.height - 10);
}

function spawnObstacle() {
  const laneWidth = canvas.width / 3;
  const lanes = [laneWidth / 2 - 30, laneWidth + laneWidth / 2 - 30, laneWidth * 2 + laneWidth / 2 - 30];
  const randomLane = lanes[Math.floor(Math.random() * lanes.length)];

  obstacles.push({
    x: randomLane,
    y: -60,
    width: 60,
    height: 80,
    color: '#f39c12'
  });
}

function updateCar() {
  if (keys['ArrowLeft'] && car.x > 0) {
    car.x -= 5;
  }
  if (keys['ArrowRight'] && car.x < canvas.width - car.width) {
    car.x += 5;
  }
}

function updateObstacles() {
  for (let i = obstacles.length - 1; i >= 0; i--) {
    obstacles[i].y += gameSpeed;

    if (obstacles[i].y > canvas.height) {
      obstacles.splice(i, 1);
      score += 10;
      scoreElement.textContent = score;
    }
  }
}

function checkCollision() {
  for (let obstacle of obstacles) {
    if (
      car.x < obstacle.x + obstacle.width &&
      car.x + car.width > obstacle.x &&
      car.y < obstacle.y + obstacle.height &&
      car.y + car.height > obstacle.y
    ) {
      return true;
    }
  }
  return false;
}

function updateSpeed() {
  speed = Math.floor(score / 100) + 1;
  gameSpeed = 2 + speed * 0.5;
  speedElement.textContent = speed;
}

function gameLoop() {
  if (!gameRunning) return;

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  drawRoad();
  updateCar();
  drawCar();

  obstacleSpawnTimer++;
  if (obstacleSpawnTimer > 60 - speed * 5) {
    spawnObstacle();
    obstacleSpawnTimer = 0;
  }

  updateObstacles();
  obstacles.forEach(drawObstacle);

  updateSpeed();

  if (checkCollision()) {
    endGame();
    return;
  }

  animationId = requestAnimationFrame(gameLoop);
}

function startGame() {
  gameRunning = true;
  score = 0;
  gameSpeed = 2;
  speed = 1;
  roadOffset = 0;
  obstacles.length = 0;
  obstacleSpawnTimer = 0;
  car.x = canvas.width / 2 - 25;
  car.y = canvas.height - 120;

  scoreElement.textContent = score;
  speedElement.textContent = speed;
  gameOverDiv.style.display = 'none';

  gameLoop();
}

function endGame() {
  gameRunning = false;
  cancelAnimationFrame(animationId);

  finalScoreElement.textContent = score;

  if (score > highScore) {
    highScore = score;
    localStorage.setItem('highScore', highScore);
    highScoreElement.textContent = highScore;
  }

  gameOverDiv.style.display = 'block';
}

function restartGame() {
  startGame();
}

document.addEventListener('keydown', (e) => {
  keys[e.key] = true;
  if (e.key === ' ' && !gameRunning) {
    e.preventDefault();
    startGame();
  }
});

document.addEventListener('keyup', (e) => {
  keys[e.key] = false;
});

window.addEventListener('load', () => {
  drawRoad();
  drawCar();
  
  const startMessage = document.createElement('div');
  startMessage.style.cssText = `
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    z-index: 50;
  `;
  startMessage.innerHTML = `
    <h2 style="margin-bottom: 15px;">Готові до гонки?</h2>
    <p style="margin-bottom: 15px;">Натисніть ПРОБІЛ для початку</p>
    <p style="font-size: 14px; color: #bbb;">Використовуйте стрілки ⬅️ ➡️ для керування</p>
  `;
  document.querySelector('.game-container').appendChild(startMessage);

  document.addEventListener('keydown', function startHandler(e) {
    if (e.key === ' ') {
      e.preventDefault();
      startMessage.remove();
      startGame();
      document.removeEventListener('keydown', startHandler);
    }
  });
});

