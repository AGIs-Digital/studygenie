const plusIcons = document.querySelectorAll(".plusIcon");
const crossIcons = document.querySelectorAll(".crossIcon");
const VideoIcon = document.querySelectorAll(".VideoIcon");
let imageArray;
const video = Array.from(document.getElementsByTagName("video"));
plusIcons.forEach((plusIcon) => {
	plusIcon.addEventListener("click", (event) => {
		const element = event.target;
		const parentEle = event.target.parentNode;
		const parentNode = element.parentNode.parentNode;
		const crossIcon = parentEle.querySelector(".crossIcon");
		const answerDiv = parentNode.querySelector(".answerContentContainer");
		answerDiv.classList.add("showAnswerDiv");
		element.classList.add("hidePlusIcon");
		crossIcon.classList.add("showCrossIcon");
	});
});
crossIcons.forEach((crossIcon) => {
	crossIcon.addEventListener("click", (event) => {
		const element = event.target;
		const plusIcon = element.previousElementSibling;
		const answerDiv = element.parentNode.nextElementSibling;
		crossIcon.classList.remove("showCrossIcon");
		plusIcon.classList.remove("hidePlusIcon");
		answerDiv.classList.remove("showAnswerDiv");
	});
});
VideoIcon.forEach((videcard) => {
	videcard.addEventListener("click", (e) => {
		const parentDIv = e.target.parentNode;
		const images = parentDIv.getElementsByTagName("img");
		const video = parentDIv.getElementsByTagName("video");
		imageArray = Array.from(images);
		imageArray.forEach((ele) => {
			ele.classList.add("showVideoIcon");
			video[0].style.display = "block";
		});
	});
});
video.forEach((ele) => {
	ele.addEventListener("click", (e) => {
		e.stopPropagation();
		imageArray.forEach((image) => {
			image.classList.remove("showVideoIcon");
			ele.style.display = "none";
		});
	});
});
