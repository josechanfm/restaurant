<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  bottom: 0;
  margin-bottom: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

</style>
  <div class="navbar">
    <a href="./" class="active">Home</a>
    <a href="#news">Notice</a>
    <a href="./profile/info/edit/<?=$member->id?>">Info</a>
    <a href="./profile/logout">Logout</a>
  </div>