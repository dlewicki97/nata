stars();

function stars() {
    let modalStars = document.getElementsByClassName("modal-stars")[0];
    if (!modalStars) return;
    let stars = modalStars.getElementsByClassName("star");

    let baseUrl = window.location.origin;
    baseUrl += baseUrl.includes('localhost') ? '/nata/' : '/';

    let filledStar = `${baseUrl}assets/front/img/single-product/rating/star-filled.svg`;
    let outlineStar = `${baseUrl}assets/front/img/single-product/rating/star-outline.svg`;
    let greyStar = `${baseUrl}assets/front/img/single-product/rating/star-grey.svg`;

    stars.forEach((star, i) => {
        star.addEventListener("mouseover", () => {
            for (let j = 0; j < i + 1; j++) stars[j].src = filledStar;
        });
        star.addEventListener("mouseout", () => {
            for (
                let j = 4; j >= parseInt(document.getElementById("stars-value").value); j--
            ) {
                stars[j].src = outlineStar;
            }
        });
        star.addEventListener("click", () => {
            fillStars(i);
        });
    });

    function fillStars(starIndex) {
        document.getElementById("stars-value").value = starIndex + 1;
        let outerStars = document
            .getElementsByClassName("outer-stars")[0]
            .getElementsByClassName("star");
        outerStars.forEach((star) => (star.src = greyStar));
        for (let i = 0; i < starIndex + 1; i++) {
            stars[i].src = filledStar;
            outerStars[i].src = filledStar;
        }
    }
}