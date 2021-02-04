<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
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
            <li><a class="geel" href="#about-us">Wie zijn we?</a></li>
            <li><a class="watdoen" href="#what">Wat doen we?</a></li>
            <li><a class="helpen" href="#handje">Handje helpen!</a></li>
            <li><a class="ons" href="#contact">Ons bereiken</a></li>
            <li><a class="doni" href="#donatie">Donatie</a></li>
          </ul>
        </div>
      </nav>
      <nav>
        <div class="taalnav">
          <ul>
            <li><a class="fr" href="stapsteen-fr.php">Fr</a></li>
            <li><a class="en" href="stapsteen-en.php">Eng</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <main>
      <section id="home">
        <img class="logo-back" src="img/nieuw-logo.png" alt="" />
        <div>
          <p class="passie">mensen met passie,</p>
          <p class="steunpunt">een steunpunt,</p>
          <h1 class="staphome">STAPSTEEN</h1>
        </div>
      </section>

      <section class="sticky">
        <div class="logotop">
          <a href="#top"><img src="img/Logo+tekst.png" alt="" /></a>
        </div>
        <section id="about-us">
          <div class="titels1">
            <p class="wbo">Wat beweegt ons?</p>
            <h2 class="wzw">Wie zijn we?</h2>
          </div>

          <div class="text">
            <p>
              We zijn een <b>steunpunt</b> voor kwetsbare gezinnen in en rond
              <b>Brussel</b> die het moeilijk <br />
              hebben om rond te komen en/of aansluiting te vinden bij de
              samenleving. <br />
              Ze hebben heel concreet behoefte aan een sociaal netwerk, aan
              ondersteuning in <br />
              de opvoeding en in de praktische leefomstandigheden van het gezin.
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
                Mensen met passie, professionelen en <b>vrijwilligers</b>, die
                een steunpunt willen zijn voor de gezinnen die we ontmoeten.
              </p>
              <p>
                Onze motivatie en inspiratie halen we uit onze
                <b>christelijke</b> levensovertuiging.
              </p>
              <p>
                Bij gezinnen leeft <b>de vraag</b> hoe ze vandaag vanuit
                christelijke waarden vorm kunnen geven aan hun gezin.
                <br />
                We willen hierin met hen <b>reisgenoten</b> zijn en vorming en
                ontmoeting rond deze thema’s aanbieden.
              </p>
            </div>
          </div>
        </section>
        <section id="what">
          <div class="titels">
            <p class="bezoek">Bezoekteam</p>
            <h2 class="wzw">Wat doen we?</h2>
            <p class="spelo">Spelotheek</p>
            <p class="kids">StapSteen Kids</p>
          </div>
          <div class="activi">
            <div>
              <h3>StapSteen Kids</h3>
              <p>
                StapSteen kids is een <b>kinderwerking</b> voor de gezinnen in
                de buurt van ons StapSteen huis in Laken. Deze kinderclub gaat
                tweewekelijks door op zondagnamiddag.
              </p>
              <p>
                De <b>activiteiten</b> kunnen gaan van knutselen tot koken of
                sport en spel. <br />
                We proberen een divers programma aan te bieden.
              </p>
            </div>
            <img src="img/austin-pacheco-FtL07GM9Q7Y-unsplash.jpg" alt="" />
          </div>
          <div class="activi2">
            <img src="img/abigail-miller-r4sxIf0gTfs-unsplash.jpg" alt="" />
            <div>
              <h3>Bezoekteam</h3>
              <p>
                Vrijwilligers die een <b>gezin ondersteunen</b> door hen
                regelmatig thuis te bezoeken en deel te nemen aan hun dagelijkse
                bezigheden en/of praktische dienstverlening, dat is ons
                bezoekteam.
              </p>
              <p>
                Door de regelmatige aanwezigheid van de vrijwilliger binnen het
                gezin, willen we de draagkracht en vaardigheden van de opvoeders
                vergroten, het sociaal netwerk van het gezin verbreden en
                preventief bijdragen tot het <b>welzijn van de kinderen</b>.
              </p>
            </div>
          </div>
          <div class="activi3">
            <div>
              <h3>Spelotheek</h3>
              <p>
                In onze spelotheek kan je <b>gezelschapsspelletjes</b> uitlenen
                zoals je in een bibliotheek boeken leent.
              </p>
              <p>
                We hebben een <b>divers aanbod</b> aan spelletjes voor kinderen
                van 1 tot 12 jaar.
              </p>
              <p>
                We doorbreken het isolement, die eigen is aan de stedelijke
                context, door plaatsen van <b>ontmoeting te stimuleren</b>. De
                spelotheek is een toegankelijke manier om ouders en kinderen te
                bereiken.
              </p>
              <p>
                <b>Openingsuren:</b> Woensdag van 13-17u <br />
                Vanwege covid enkel mogelijk op afspraak, via 0471 86 01 23
              </p>
            </div>
            <img src="img/sigmund-OV44gxH71DU-unsplash.jpg" alt="" />
          </div>
        </section>

        <section class="memory">
          <a href="dist/memory.html" target="blank">Memory Spel</a>
          <a href="pdf/stapsteen-spel.zip"
            >Download het memory spel en print het af!</a
          >
        </section>

        <section id="handje">
          <div class="titels">
            <p class="bezoek">Vrijwilliger worden?</p>
            <h2 class="wzw">Handje helpen!</h2>
          </div>
          <div class="texthelp">
            <p>
              De <b>StapSteen vrijwilliger</b> wil een gezin ondersteunen waar
              de ouders, om verschillende redenen, <br />
              het moeilijk hebben om aan hun jonge kinderen (tot 12 jaar) de
              nodige nestwarmte, geborgenheid <br />
              en structuur te bieden.
            </p>
          </div>
          <div class="form">
            <img src="img/austin-kehmeier-lyiKExA4zQA-unsplash.jpg" alt="" />
            <div class="formtext">
              <p>Al vrijwilliger? <b>Login</b> op ons platform</p>
              <div class="vrijplat">
                <a href="login.php">Vrijwilligers platform</a>
              </div>

              <p>
                Wil je graag meer informatie of wil je meewerken <br />
                met het bezoekteam? <br />
                <b>Meld je aan</b> als vrijwilliger op deze website!
              </p>
              <form class="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                  <p>Je naam:</p>
                  <input  type="text" name="username" class="form-control" value="" />
                  <p>Wachtwoord:</p>
                  <input type="password" name="password" class="form-control" value="">
                  <p>Wachtwoord herhalen:</p>
                  <input type="password" name="confirm_password" class="form-control" value="">
                </div>
                <div class="form-group">
                  <button type="submit" value="Submit">Aanmelden</button>
                  <button type="reset" value="Reset">reset</button>
              </div>
              <p  style="margin-left:7%">Heb je al een account? <a href="login.php">Login hier</a>.</p>
              </form>
            </div>
          </div>
        </section>
        <section id="contact">
          <div class="titels">
            <p class="bezoek">Een prangende vraag?</p>
            <h2 class="wzw">Ons bereiken</h2>
            <p class="info">Meer info?</p>
          </div>
          <div class="bereiken">
            <form class="contact2" action="POST" data-netlify="true">
              <h4>Contact formulier</h4>
              <div>
                <p>Je naam:</p>
                <input type="text" name="name" id="name" />
                <p>Je e-mail:</p>
                <input type="email" name="email" id="email" />
                <p>Je bericht:</p>
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
                Ook te contacteren voor de Spelotheek, StapSteen kids, <br />
                Kinderopvang en projecten. <br />
                Bereikbaar op maandag, dinsdag en donderdag.
              </p>
              <p>0487/95 08 69</p>
              <i>miet@stapsteen.be</i> <br />

              <h5>Lisette Hendriksen</h5>
              <p>
                Contactpersoon bezoekteam en vrijwilligerswerking. <br />
                Bereikbaar op dinsdag, woensdag en donderdag.
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
            <p class="bezoek">Een lieve bijdrage</p>
            <h2 class="wzw">Doneren</h2>
          </div>

          <div class="doneren">
            <div class="textdon">
              <p>
                Met jouw bijdrage geef je ons team een <b>grotere kans</b> om
                ouders beter te kunnen steunen.
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
                  <script
                    src="https://apps.elfsight.com/p/platform.js"
                    defer
                  ></script>
                  <div
                    class="elfsight-app-e7ee74d0-a037-4647-b4e5-faac590a00c1"
                  ></div>
                </div>
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
