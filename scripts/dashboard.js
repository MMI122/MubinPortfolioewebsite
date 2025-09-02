// document.querySelectorAll("ul li a").forEach(function(a){
//     a.addEventListener("click",function(event){
//       // prevent the default action of following the link
//       // remove the active class from all other anchor tags
//       document.querySelectorAll("ul li a").forEach(function(b){
//         b.classList.remove("active");
//       });
//       // add the active class to the clicked anchor tag
//       a.classList.add("active");
//     });
//   });

document.querySelectorAll(".delete").forEach(function(e) {
    e.addEventListener("click", function() {
        document.querySelector(".hide-content").style.display = "block";
        document.querySelector(".pop-delete").style.display = "block";

        const Id = this.getAttribute('data-id');

        document.querySelector('.pop-delete input[name="Id"]').value = Id;
    })
});

document.querySelectorAll(".box .info .edit").forEach(function(e) {
    e.addEventListener("click", function() {

        document.querySelector(".hide-content").style.display = "block";
        document.querySelector(".pop-edit").style.display = "block";

        const Id = this.getAttribute('data-id');
        const Name = this.getAttribute('data-name');
        const Image = this.getAttribute('data-image');
        const Job = this.getAttribute('data-job');
        const Gender = this.getAttribute('data-gender');

        // Populate the form fields with the  data
        if (Id != null)
            document.querySelector('.pop-edit input[name="Id"]').value = Id;
        if (Name != null)
            document.querySelector('.pop-edit input[name="Name"]').value = Name;
        if (Image != null)
            document.querySelector('.pop-edit input[name="ImageOld"]').value = Image;
        if (Job != null)
            document.querySelector('.pop-edit input[name="Job"]').value = Job;
        if (Gender != null)
            document.querySelector('.pop-edit select[name="Gender"]').value = Gender;

        const imageContainer = document.getElementById('imageContainer');
        const thumbnail = document.createElement('img');
        thumbnail.src = '../images/' + Image;
        imageContainer.innerHTML = ''; // Clear previous thumbnail
        imageContainer.appendChild(thumbnail);

    })
});

document.querySelectorAll(".add").forEach(function(e) {
    e.addEventListener("click", function() {
        document.querySelector(".hide-content").style.display = "block";
        document.querySelector(".pop-add").style.display = "block";
    })
});

document.querySelectorAll(".pop-message .cancel").forEach(function(e) {
    e.addEventListener("click", function(e) {
        document.querySelector(".hide-content").style.display = "none";
        document.querySelector(".pop-edit").style.display = "none";
        document.querySelector(".pop-delete").style.display = "none";
        document.querySelector(".pop-add").style.display = "none";
        e.preventDefault();
    })
});