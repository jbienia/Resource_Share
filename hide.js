function onLoad()
{

  document.getElementById("homeMaintenanceLabel").addEventListener("click",homeMaintenanceVisible,false);
  document.getElementById('homeMaintenance').style.display="none";

  document.getElementById("educationLabel").addEventListener("click",educationVisible,false);
  document.getElementById('education').style.display="none";

  document.getElementById("foodLabel").addEventListener("click",foodVisible,false);
  document.getElementById('food').style.display="none";



  document.getElementById("variousLabel").addEventListener("click",variousLabel,false);
  document.getElementById('label').style.display="none";


}

function homeMaintenanceVisible(e)
{
  document.getElementById('homeMaintenance').style.display="block";
  e.preventDefault();
}

function educationVisible(e)
{
  document.getElementById('education').style.display="block";
  e.preventDefault();
}

function foodVisible(e)
{
  document.getElementById('food').style.display="block";
  e.preventDefault();
}

function variousLabel(e)
{
  document.getElementById('label').style.display="block";
  e.preventDefault();
}

document.addEventListener("DOMContentLoaded", onLoad, false);
