const namaSaya = "jepri simbolon";
let usia = 10;

let biodata = document.getElementById('biodata')

function generateBiodata() {
    let generasi;

    if (usia >= 2 && usia <= 10) {
        generasi = "generasi anak-anak"
    } else if (usia >= 10 && usia <= 18) {
        generasi = "generasi remaja"
    } else if (usia >= 19 && usia <= 50) {
        generasi = "generasi dewasa"
    } else {
        generasi = "wah ada sepuh nih, ampun sepuh :)"
    }

    return biodata.innerHTML = generasi;
}

console.log(namaSaya);
console.log(usia);

generateBiodata();