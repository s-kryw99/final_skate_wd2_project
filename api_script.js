// api url
const api_url = "https://data.winnipeg.ca/resource/tx3d-pfxq.json";
function startUp(){
document.getElementById("pressIt").addEventListener("click", doclick, {once : true});
}


function doclick() {
// e.preventDefault();
query = document.getElementById('neighbourhood').value;
getapi(api_url, query);
console.log(query);
}


async function getapi(url, query) {

  if (!query)
  {
  query = "";

  }
    const response = await fetch(url + "?$WHERE=park_id=1054 OR park_id =500 OR park_id =622 OR park_id =1017 OR park_id =1228 OR park_id =710 OR park_id =156 OR park_id =968 OR park_id =1451 OR park_id =1045 OR park_id =635 OR park_id =107 OR park_id =306 OR park_id =20 OR park_id =153 OR park_id =558 AND district LIKE '"+query+"%25'");



    // Storing response


    // Storing data in form of JSON

    var data = await response.json();

    console.log(data);

    if (response) {

        hideloader();

    }

    show(data);

}
// Calling that async function
getapi(api_url);

// var errLogs = [];


// Function to hide the loader

function hideloader() {
  // document.write(response);
    document.getElementById('loading').style.display = 'none';
}
// Function to define innerHTML for HTML table

function show(data) {

    let tab =
        `<tr>
          <th>park_name</th>

          <th>neighbourhood</th>

          <th>district</th>

          <th>location</th>
         </tr>`;
    // Loop to access all rows

    for (let r of data)
    {

        tab += `<tr>

    <td>${r.park_name} </td>

    <td>${r.neighbourhood} </td>

    <td>${r.district} </td>

    <td>   <a href= "https://www.google.com/maps/@${r.location.latitude},${r.location.longitude},15z"> visit on google </a> </td>

</tr>`;


    }
    // Setting innerHTML as tab variable
    document.getElementById("location_description").innerHTML = tab;
}

document.addEventListener("DOMContentLoaded", startUp);
