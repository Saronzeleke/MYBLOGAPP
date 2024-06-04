<style>
/*  Header styles  */
header {
    background-color: #3498db;
    color: #fff;
    padding: 20px;
    padding-inline: 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 90px;
    z-index: 9999
}

.logo-container img {
    height: 40px;
}
.logo-container .logo {
    margin-top: 5px;
    margin-left: -66px;
    padding: 5px;
    width: 90px; 
    height: 70px;
    border-radius: 15px;

}
nav a:first-child {
    margin-left: 0;
}

nav a:hover {
    color: #302f2f;
}

.navigation {
    font-size: 19px;
    display: flex;
    justify-content: space-between; /* Adjust as needed */
    align-items: center; /* Vertically center the items */
    padding: 10px; /* Add some padding for spacing */
    color: #fff;
    text-decoration: none;
    margin-left: 20px;
    transition: color 0.3s ease;
}

.navigation a {
    text-decoration: none;
    color: #333; /* Adjust the color as needed */
    margin-right: 20px; /* Adjust the spacing between links */
}

.navigation form {
    margin: 0; /* Remove any default margins */
}

.navigation button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    color: #333; /* Adjust the color as needed */
    padding: 0; /* Remove any default padding */
    font-size: inherit; /* Inherit the font size from the parent */
}

.action {
  position: fixed;
  top: 20px;
  right: 30px;
}

.action .profile {
  position: relative;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  overflow: hidden;
  cursor: pointer;
}

.action .profile img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.action .menu {
  position: absolute;
  top: 120px;
  right: -10px;
  padding: 10px 20px;
  background: powderblue;
  width: 200px;
  box-sizing: 0 5px 25px rgba(0, 0, 0, 0.1);
  border-radius: 15px;
  transition: 0.5s;
  visibility: hidden;
  opacity: 0;
}
.username{
    color: #fff !important;
}
.action .menu.active {
  top: 80px;
  visibility: visible;
  opacity: 1;
}

.action .menu::before {
  content: "";
  position: absolute;
  top: -5px;
  right: 28px;
  width: 20px;
  height: 20px;
  background: powderblue;
  transform: rotate(45deg);
}

.action .menu h3 {
  width: 100%;
  text-align: center;
  font-size: 18px;
  padding: 20px 0;
  font-weight: 500;
  color: #555;
  line-height: 1.5em;
}

.action .menu h3 span {
  font-size: 14px;
  color: #cecece;
  font-weight: 300;
}

.action .menu ul li {
  list-style: none;
  padding: 16px 0;
  border-top: 1px solid rgba(0, 0, 0, 0.05);
  display: flex;
  align-items: center;
}

.action .menu ul li img {
  max-width: 20px;
  margin-right: 10px;
  opacity: 0.5;
  transition: 0.5s;
}

.action .menu ul li:hover img {
  opacity: 1;
}

.action .menu ul li a {
  display: inline-block;
  text-decoration: none;
  color: #555;
  font-weight: 500;
  transition: 0.5s;
}

.action .menu ul li:hover a {
  color: #fff;
}


</style>

<?php

?>
<header>
    <div class="logo-container">
        <a href="index.php">
            <img class="logo" src="pic.png" alt="Logo">
        </a>
    </div>
    <nav class="navigation">
        <a href="dashboard.php">Home</a>
        <a href="addblog.php">Post</a>
        <div class="action">
            <div class="profile" onclick="menuToggle();">
                <img src="<?php echo $_SESSION['authorImg']; ?>" />
            </div>
            <div class="menu">
                <h3><?php echo $_SESSION['firstName']; ?><br /><span class="username">@<?php echo $_SESSION['username']; ?></span></h3>
                <ul>
                <li>
                    <img src="./Assets/icons/user.png" /><a href="#">My profile</a>
                </li>
                <li>
                    <img src="./Assets/icons/settings.png" /><a href="#">Setting</a>
                </li>
                <li>
                    <img src="./Assets/icons/log-out.png" />
                    <form action="logout.php" method="post">
                        <button type="submit" name="logout">Logout</button>
                    </form>
                </li>
                </ul>
            </div>
        </div>
        
    </nav>
</header>

<script>
    function menuToggle() {
    const toggleMenu = document.querySelector(".menu");
    toggleMenu.classList.toggle("active");
    }
</script>

