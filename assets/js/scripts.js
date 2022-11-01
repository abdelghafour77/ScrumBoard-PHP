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
      document.getElementById("id").value = '';
      document.getElementById('form').reset();
}
// function deleteTask() {
//       document.getElementById("id").value = '';
// }

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
function setType(type) {
      document.getElementById('type').setAttribute("name", type);
}


const validation = new JustValidate('#form');
validation
      .addField('#title', [{
            rule: 'minLength',
            value: 3,
            errorMessage: 'Title is too short !',
      },
      {
            rule: 'required',
            errorMessage: 'Title required !',

      },
      {
            rule: 'maxLength',
            value: 255,
            errorMessage: 'title is too long !',

      },
            // {
            //       rule: 'customRegexp',
            //       value: /([A-z\s])/gi,
            // },
      ])
      .addField('#priority', [{
            rule: 'required',
            errorMessage: 'Priority required !',

      },])
      .addField('#status', [{
            rule: 'required',
            errorMessage: 'Status required !',

      },])
      .addField('#date', [{
            rule: 'required',
            errorMessage: 'Date required !',

      },])
      .addField('#description', [{
            rule: 'required',
            errorMessage: 'Description required !',

      },])
      .onSuccess((event) => {
            event.currentTarget.submit();
      });


function delteValidation() {
      event.preventDefault();
      Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
            if (result.isConfirmed) {
                  document.getElementById("form").submit();
            }
      })
}
