document.addEventListener("DOMContentLoaded", () => {
  const allElements = document.querySelectorAll("*");

  allElements.forEach(el => {
    let originalBg = "";

    el.addEventListener("mouseenter", () => {
      originalBg = el.style.backgroundColor; 
      el.style.backgroundColor = "red";      
    });

    el.addEventListener("mouseleave", () => {
      el.style.backgroundColor = originalBg;
    });
  });

  setTimeout(() => {
    loadImages();
  }, 5000);
});

function loadImages() {
  let imagesUrl = [
    "https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Wikipedia-logo-v2.svg/200px-Wikipedia-logo-v2.svg.png",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/Wikipedia-logo.png/200px-Wikipedia-logo.png",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Wikipedia_mobile_app_logo.png/200px-Wikipedia_mobile_app_logo.png",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Wikipedia_Logo_1.0.png/200px-Wikipedia_Logo_1.0.png",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/200px-Google_2015_logo.svg.png"
  ];

  const container = document.getElementById("images-container");
  
  if (!container) {
    console.error("Контейнер для зображень не знайдено");
    return;
  }

  const fragment = document.createDocumentFragment();

  imagesUrl.forEach((url, index) => {
    const img = document.createElement("img");
    img.src = url;
    img.alt = "Зображення " + (index + 1);
    img.style.maxWidth = "200px";
    img.style.margin = "10px";
    img.style.borderRadius = "5px";
    img.style.boxShadow = "0 2px 5px rgba(0,0,0,0.1)";
    
    fragment.appendChild(img);
  });

  const images = Array.from(fragment.childNodes);

  images.forEach((img, index) => {
    setTimeout(() => {
      container.appendChild(img);
    }, index * 1000);
  });
}
