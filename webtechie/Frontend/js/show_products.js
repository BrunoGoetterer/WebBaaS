document.addEventListener("DOMContentLoaded", async function () {
  const response = await fetch(
    `http://localhost/webtechie/Backend/api.php?resource=products`
  );
  const data = await response.json();

  if (data.length === 0) {
    document.getElementById("productList").innerHTML = "No products found";
    return;
  }

  let output = "";

  for (let i = 0; i < data.length; i++) {
    if (i % 3 == 0) {
      output += '<div class="row">';
    }

    const product = data[i];

    output += `
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="../../Backend/${product["image"]}" class="card-img-top" alt="${product.title}">
                    <div class="card-body">
                        <h5 class="card-title">${product.title}</h5>
                        <p class="card-text">€ ${product.price}</p>
                        <h6 class="card-title">${product.tags}</h6>
                    </div>
                </div>
            </div>
        `;

    if (i % 3 == 2) {
      output += "</div>";
    }
  }

  document.getElementById("productList").innerHTML = output;
});
// Dieser Code lädt beim Laden der Seite eine Liste von Produkten von einer API und zeigt sie dynamisch auf der Webseite an.