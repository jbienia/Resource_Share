function passwordVerify(form)
{
  var password = document.getElementById('password').value;
  var reEnterPassword = document.getElementById('reEnterPassword').value;

  if(password != reEnterPassword)
  {

    alert('Passwords Must Match');
    return false;
    header("location:index.php");
    exit;

    //header("location:index.php");
    //exit;
  }
}
