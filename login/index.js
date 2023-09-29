// let container = document.getElementById('container')

// toggle = () => {
// 	container.classList.toggle('sign-in')
// 	container.classList.toggle('sign-up')
// }

// setTimeout(() => {
// 	container.classList.add('sign-in')
// }, 200)
// function rotateRectangle() {
//     const rectangle = document.getElementById("clickableRectangle");
//     rectangle.classList.toggle("don-t-have-an-account-sign-up-span3");
//   }
$(".don-t-have-an-account-sign-up").click(function () {
  $(this).parents(".rectangle-3__side--side").toggleClass("flipped");
});
$(".clickcard").click(function () {
  $(this).toggleClass("flipped");
});


  