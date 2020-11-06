// import $ from 'jquery';

// class Like {
//     constructor() {
//         this.events();
//     }

//     events() {
//         $(".like-box").on("click", this.ourClickDispatcher.bind(this));
//     }

//     //Methods
//     ourClickDispatcher(e) {
//         var currentLikeBox = $(e.target).closest(".like-box");

//         if (currentLikeBox.attr('data-exists') == 'yes') {
//             this.deleteLike(currentLikeBox);
//         } else {
//             this.createLike(currentLikeBox);
//         }
//     }

//     createLike(currentLikeBox) {
//         $.ajax({
//             beforeSend: (xhr) => {
//                 xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
//             },
//             url: universityData.root_url + '/wp-json/university/v1/manageLike',
//             type: 'POST',
//             data: { 'professorId': currentLikeBox.data('professor') },//Equal to url with "?professorId=64" appended
//             success: (response) => {
//                 currentLikeBox.attr('data-exists', 'yes');//Fill heart by setting "data-exists" attr to "yes"
//                 var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10); //Get likeCount number from frontend and save as var
//                 likeCount++;
//                 currentLikeBox.find(".like-count").html(likeCount); //Update like-count on frontend
//                 currentLikeBox.attr('data-like', response);
//                 console.log(response);
//             },
//             error: (response) => {
//                 console.log(response);
//             }
//         });
//     }

//     deleteLike(currentLikeBox) {
//         $.ajax({
//             beforeSend: (xhr) => {
//                 xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
//             },
//             url: universityData.root_url + '/wp-json/university/v1/manageLike',
//             data: { 'like': currentLikeBox.attr('data-like') },
//             type: 'DELETE',
//             success: (response) => {
//                 currentLikeBox.attr('data-exists', 'no');//Fill heart by setting "data-exists" attr to "yes"
//                 var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10); //Get likeCount number from frontend and save as var
//                 likeCount--;
//                 currentLikeBox.find(".like-count").html(likeCount); //Update like-count on frontend
//                 currentLikeBox.attr('data-like', '');
//                 console.log(response);
//             },
//             error: (response) => {
//                 console.log(response);
//             }
//         });
//     }

// }

// export default Like;