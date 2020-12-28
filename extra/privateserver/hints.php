<?php 

$hint = rand(1,9);

switch ($hint) {
  case 1:
    $tip = "&#128172 <u>Hint</u>: You can almost go in and out anonymously!<br><br> <i>Know a lobby name?</i> You can invite/join your friends<br> <i>Have a key?</i> You can control the lobby settings";
    break;
  case 2:
    $tip = "&#128172 <i>Do you know?</i> HEMI includes various levels of security from encrypting lobby key, database attack prevention and end-to-end encryption<br> It even provides a filter to censor swear words! <i>Happy chatting!</i>";
    break;
  case 3:
    $tip = "&#129488; <i>Like to know how this works?</i> HEMI is the most transparent messenger you've probably used.<br> Hop on to <i>github/stringtherapy</i> to check the source code and see every aspect of the application including what caused this very line to appear!<br> <i>Happy learning!</i>";
    break;
  case 4:
    $tip = "&#128077; <i>Like the idea of open source messenger?</i> You can contribute to <i>github/stringtherapy</i> with any skills of your choice!<br> <i>Happy Coding!</i>";
    break;
  case 5:
    $tip = "&#128587; <i>Are you an aspiring developer?</i> Get the source code from <i>github/stringtherapy</i> and test HEMI on your local machine in just few steps.<br> Then you can modify your code anyway you like to create personalised variants!";
    break;
  case 6:
    $tip = "&#129300; <i>Not sure about private messengers?</i> Get the source code from <i>github/stringtherapy</i> and follow few simple steps to have your own personal messenger live in the domain of your choice!";
    break;
  case 7:
    $tip = "&#128078;<i>Have any suggestions or feedback?</i> Get back to the home page, hop in the public server and share your thoughts with the community! ";
    break;  
  case 8:
    $tip = "&#128076; <i>Love the images?</i> Credits go to amazing photographers from <i>unsplash</i> and <i>pexels</i> ";
    break;  
  case 9:
    $tip = "&#129309; The End-to-end encryption for <i>hemi.ga</i> is provided by <i>Cloudflare Services</i>";
    break;  
}


echo "<p style=text-align:center;color:white;opacity:60%> $tip <br></p>";

?>