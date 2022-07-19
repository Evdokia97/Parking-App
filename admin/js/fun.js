function checkDB() {
  $.ajax({
    type: "POST",
    data: {},
    url: "db/check.php", // <=== CALL THE PHP FUNCTION HERE.
    success: function(data) {
      alert(data); // <=== VALUE RETURNED FROM FUNCTION.
    },
    error: function(xhr) {
      alert("error");
    }
  });
}

function deleteDB() {
  $.ajax({
    type: "POST",
    data: {},
    url: "db/delete.php",
    success: function(data) {
      alert(data);
    },
    error: function(xhr) {
      alert("error");
    }
  });
}

function makeDB() {
  $.ajax({
    type: "POST",
    data: {},
    url: "db/make.php",
    success: function(data) {
      alert(data);
    },
    error: function(xhr) {
      alert("error");
    }
  });
}
function startDB() {
  $.ajax({
    type: "POST",
    data: {},
    url: "db/start.php",
    success: function(data) {
      alert(data);
    },
    error: function(xhr) {
      alert("error");
    }
  });
}
function loadDB() {
  $.ajax({
    type: "POST",
    data: {},
    url: "db/tables.php",
    success: function(data) {
      alert(data);
    },
    error: function(xhr) {
      alert("error");
    }
  });
}

function loaderDB() {
  $.ajax({
    type: "POST",
    data: {},
    url: "db/loader.php",
    success: function(data) {
      alert(data);
    },
    error: function(xhr) {
      alert("error");
    }
  });
}

