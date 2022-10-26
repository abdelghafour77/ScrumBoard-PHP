function getTask() {
      let id = document.getElementsByName("id").getAttribute("value");
      let title = document.getElementsByName("title").values;
      let priority = document.getElementsByName("priority").values;
      let status = document.getElementsByName("status").values;
      let type = document.getElementsByName("type").values;
      let date = document.getElementsByName("date").values;
      let description = document.getElementsByName("description").values;
      console.log(id, title, priority, status, type, date, description);
}