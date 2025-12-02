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
});
