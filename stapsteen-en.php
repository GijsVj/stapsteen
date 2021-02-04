<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: login-en.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap"
      rel="stylesheet"
    />
    <title>StapSteen</title>
  </head>

  <body id="top">
    <header>
      <nav>
        <div class="navside">
          <ul>
            <li><a class="geel" href="#about-us">Who are we?</a></li>
            <li><a class="watdoen" href="#what">What are we doing?</a></li>
            <li><a class="helpen" href="#handje">Helping out!</a></li>
            <li><a class="ons" href="#contact">Reach us</a></li>
            <li><a class="doni" href="#donatie">Make a donation</a></li>
          </ul>
        </div>
      </nav>
      <nav>
        <div class="taalnav">
          <ul>
            <li><a class="fr" href="stapsteen-fr.php">Fr</a></li>
            <li><a class="en" href="index.php">Nl</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <main>
      <section id="home">
        <img class="logo-back" src="img/nieuw-logo.png" alt="" />
        <div>
          <p class="passie">passionate people,</p>
          <p class="steunpunt">a support,</p>
          <h1 class="staphome">STAPSTEEN</h1>
        </div>
      </section>

      <section class="sticky">
        <div class="logotop">
          <a href="#top"><img src="img/Logo+tekst.png" alt="" /></a>
        </div>
        <section id="about-us">
          <div class="titels1">
            <p class="wbo">What moves us?</p>
            <h2 class="wzw">Who are we?</h2>
          </div>

          <div class="text">
            <p>
              we are a <b>support point</b> for vulnerable families in and
              around Brussels who are <br />
              struggling to make ends meet and to connect with the society.
            </p>
          </div>
          <div class="fotoentext">
            <img
              class="wzwfoto"
              src="img/conner-baker-7FC-84Ap_IU-unsplash.jpg"
              alt=""
            />
            <div class="textfoto">
              <p>
                People with passion and <b>volunteers</b>, who want to be that
                focal point support for the families we meet.
              </p>
              <p>
                We get draw our motivation and inspiration from our
                <b>Christian</b> belief.
              </p>
              <p>
                Many families <b>wonder</b> how to bring Christian values to
                their family in today’s society.

                <br />
                We want to be <b>companions</b> on their journey and offer them
                formation and encounter through these themes.
              </p>
            </div>
          </div>
        </section>
        <section id="what">
          <div class="titels">
            <p class="bezoek">Visiting Team</p>
            <h2 class="wzw">What are we doing?</h2>
            <p class="spelo">Toy Library</p>
            <p class="kids">StapSteen Kids</p>
          </div>
          <div class="activi">
            <div>
              <h3>StapSteen Kids</h3>
              <p>
                Is a <b>kids club</b> for the families in the neighbourhood of
                our StapSteen home in Laeken. This kids club meets bi-weekly on
                Sunday afternoons.
              </p>
              <p>
                The <b>activities</b> range from crafts to cooking or to sports
                and games. <br />
                We try to offer a varied program.
              </p>
            </div>
            <img src="img/austin-pacheco-FtL07GM9Q7Y-unsplash.jpg" alt="" />
          </div>
          <div class="activi2">
            <img src="img/abigail-miller-r4sxIf0gTfs-unsplash.jpg" alt="" />
            <div>
              <h3>Visiting Team</h3>
              <p>
                Volunteers who <b>support a family</b> by visiting them
                regularly at home and participating in their daily activities
                and/or offering practical service — that’s our visiting team.
              </p>
              <p>
                By the regular presence of the volunteer within the family, we
                want to enhance the capacity and skills of the caregivers, to
                widen the social network of the family and be a preventive
                contribution to the <b>welfare</b> of the children.
              </p>
            </div>
          </div>
          <div class="activi3">
            <div>
              <h3>Toy Library</h3>
              <p>
                From our toy library, you can borrow <b>board games</b> like you
                do books from a library.
              </p>
              <p>
                We have a <b>diverse range</b> of games for children from 1 to
                12 years.
              </p>
              <p>
                We want to <b>break through the isolation</b>, which is unique
                to the urban context, by providing a place where people can meet
                and interact.
                <br />
                The toy library is an accessible way for parents and their
                children to feel welcome and appreciated.
              </p>

              <p>
                <b>Opening hours:</b> Wednesday from 1 pm-5pm <br />
                Due to covid only possible by appointment, via 0471 86 01 23
              </p>            
              <img src="img/sigmund-OV44gxH71DU-unsplash.jpg" alt="" />
          </div>
        </section>

        <section class="memory">
          <a href="dist/memory.html">Memory Game</a>
          <a href="">Download the memory game and print it!</a>
        </section>

        <section id="handje">
          <div class="titels">
            <p class="bezoek">Become a volunteer?</p>
            <h2 class="wzw">Helping out!</h2>
          </div>
          <div class="texthelp">
            <p>
              The <b>StapSteen volunteer</b> wants to support a family where the
              parents, for various reasons, <br />
              have difficulties in providing the necessary nest warmth, security
              and structure at home <br />
              for their young children (under 12 years).
            </p>
          </div>
          <div class="form">
            <img src="img/austin-kehmeier-lyiKExA4zQA-unsplash.jpg" alt="" />
            <div class="formtext">
              <div class="vrijplat">
                <a href="login-en.php">Volunteer platform</a>
              </div>
              <p>
                Would you like more information or do you <br />
                want to co-operate with the visiting team? <br />
                <b>Sign up</b> as a volunteer on this website.
              </p>
              <form class="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                  <p>Your name:</p>
                  <input  type="text" name="username" class="form-control" value="" />
                  <p>Password:</p>
                  <input type="password" name="password" class="form-control" value="">
                  <p>Repeat Password:</p>
                  <input type="password" name="confirm_password" class="form-control" value="">
                </div>
                <div class="form-group">
                  <button type="submit" value="Submit">Sign up</button>
                  <button type="reset" value="Reset">reset</button>
              </div>
              <p  style="margin-left:7%">already have an account? <a href="login-en.php">Login here</a>.</p>
              </form>
            </div>
          </div>
        </section>
        <section id="contact">
          <div class="titels">
            <p class="bezoek">A pressing question?</p>
            <h2 class="wzw">Reach us</h2>
            <p class="info">More info?</p>
          </div>
          <div class="bereiken">
          <form class="contact2" action="POST" data-netlify="true">
              <h4>Contact form</h4>
              <div>
                <p>Your name:</p>
                <input type="text" name="name" id="name" />
                <p>Your e-mail:</p>
                <input type="email" name="email" id="email" />
                <p>Your message:</p>
                <textarea
                  name="message"
                  id="message"
                  cols="50"
                  rows="4"
                ></textarea>
              </div>
              <button>Send</button>
            </form>
            <div class="context">
              <h4>StapSteen VZW</h4>
              <p>
                Chrysantenstraat 33 <br />
                1020 Laken <br />
                <i>info@stapsteen.be</i><br />
              </p>

              <h5>Miet Demaerel-Vanbeckevoort</h5>
              <p>
                Coördinator StapSteen. <br />
                Also contact for Childcare Biejoeke, <br />
                Toy library, StapSteen kids and projects. <br />
                Available on Mondays, Tuesdays and Thursdays.
              </p>

              <p>0487/95 08 69</p>
              <i>miet@stapsteen.be</i><br />

              <h5>Lisette Hendriksen</h5>
              <p>
                Contact for Visiting team and volunteering.
                <br />
                Available on Tuesdays, Wednesdays and Thursdays.
              </p>
              <p>0471/86 01 23</p>
              <i>lisette@stapsteen.be</i><br />
            </div>
          </div>

          <a
            class="facebook"
            href="https://www.facebook.com/StapsteenVzw"
            target="_blank"
            >Facebook</a
          >
        </section>

        <img
          class="grootfoto"
          src="img/photo-1534982841079-afde227ada8f.jpg"
          alt=""
        />

        <section id="donatie">
          <div class="titels">
            <p class="bezoek">A kind contribution</p>
            <h2 class="wzw">Make a donation</h2>
          </div>

          <div class="doneren">
            <div class="textdon">
              <p>
                With your contribution, you give our team a
                <b>greater chance</b> to better support parents.
              </p>

              <div class="donate">
                <div class="donate-buttons">
                  <input type="radio" id="1€" name="donate" value="1" />
                  <label for="1€">1€</label><br />
                  <input type="radio" id="10€" name="donate" value="10" />
                  <label for="10€">10€</label><br />
                  <input type="radio" id="20€" name="donate" value="20" />
                  <label for="20€">20€</label>
                  <input type="radio" id="50€" name="donate" value="50" />
                  <label for="50€">50€</label>
                </div>
                <div id="div1">
                  <input class="radiobutton-donatie" type="radio" name="donate"
                  id="donate" value="Normal Radio" checked= /><input
                    type="text"
                    class="input-donatie"
                    name="donate"
                    value=""
                    placeholder="free gift"
                  />
                </div>
                <a href="#">continue</a>
              </div>
            </div>
            <img
              class="tana"
              src="img/tanaphong-toochinda-GagC07wVvck-unsplash2.jpg"
              alt=""
            />
          </div>
        </section>
      </section>
    </main>

    <footer>
      <section class="foter">
        <div class="adres">
          <p>
            Stapsteen (NPO) <br />
            33, Chrysantenstraat <br />
            B-1020 Laken (Brussels, Belgium) <br />
          </p>
          <p>IBAN BE21 6528 1576 2103</p>
        </div>
        <div class="sponsor">
          <p>Accredited and subsidized by:</p>
          <img src="img/kbs_logo.svg" alt="" />
          <img src="img/logo-Kind-en-Gezin.png" alt="" />
          <p>Sponsored by:</p>
          <img src="img/skryvLogo.svg" alt="" />
        </div>
      </section>
    </footer>
  </body>
</html>
