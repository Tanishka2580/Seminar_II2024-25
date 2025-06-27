<!DOCTYPE html>
<html>
  <head>
    <title>Student Search</title>
  </head>
  <body>
    <h2>Search Student</h2>
    <input
      type="text"
      id="search"
      placeholder="Enter student name"
      onkeyup="searchStudent()"
    />
    <div id="result"></div>

    <script>
      function searchStudent() {
        const query = document.getElementById("search").value;
        if (query.length === 0) {
          document.getElementById("result").innerHTML = "";
          return;
        }

        fetch("search.php?q=" + encodeURIComponent(query))
          .then((response) => response.text())
          .then((data) => (document.getElementById("result").innerHTML = data));
      }
    </script>
  </body>
</html>
