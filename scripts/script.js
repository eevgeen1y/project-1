const paragraphs = document.getElementsByTagName("p").length;
console.log("параграфів <p>: ", paragraphs);

const h2Count = document.getElementsByTagName("h2").length;
console.log("заголовків <h2>: ", h2Count);

const bodyBg = window.getComputedStyle(document.body).backgroundColor;
console.log("Фон <body>: ", bodyBg);

const h1 = document.querySelector("h1");
  if (h1) {
    const h1FontSize = window.getComputedStyle(h1).fontSize;
    console.log("Розмір шрифту <h1>: ", h1FontSize);
  } else {
    console.log("На сторінці немає <h1>");
  }