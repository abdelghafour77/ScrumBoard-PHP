function getTask(id) {
      let title = document.getElementById(id).children[0].children[1].children[0].getAttribute('data');
      let status = document.getElementById(id).getAttribute('data-status');
      let type = document.getElementById(id).children[0].children[1].children[4].getAttribute('data');
      let priority = document.getElementById(id).children[0].children[1].children[3].getAttribute('data');
      let date = document.getElementById(id).children[0].children[1].children[1].getAttribute('data');
      let description = document.getElementById(id).children[0].children[1].children[2].getAttribute('data');

      document.getElementById("title").value = title;
      document.getElementById("date").value = date;
      document.getElementById("description").value = description;
      document.getElementById("id").value = id;
      document.getElementById("priority").value = priority;
      if (type == "Bug") {
            document.getElementById("bug").checked = true
      } else {
            document.getElementById("feature").checked = true
      }
      document.getElementById("status").value = status;

      // Hide add button from modal
      document.getElementById("btn-update").style.display = "block";

      // Show add button from modal
      document.getElementById("btn-add").style.display = "none";
      $("#myModal").modal("show");

}
function addTask() {
      // Hide add button from modal
      document.getElementById("btn-update").style.display = "none";

      // Show add button from modal
      document.getElementById("btn-add").style.display = "block";
      document.getElementById('form').reset();

}
//  Button to top
const toTop = document.querySelector("#to-top");
window.onscroll = function () { scrollFunction() };
function scrollFunction() {
      if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
            toTop.style.display = "block";
      } else {
            toTop.style.display = "none";
      }
}

toTop.addEventListener("click", function () {
      window.scrollTo({
            top: 0,
            behavior: "smooth"
      });
})