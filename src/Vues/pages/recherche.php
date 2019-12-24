<?php $titre = "Page de recherche" ?>

<h1>Page de recherche</h1>

<form autocomplete="off" action="#">
	<div class="autocomplete" style="width:300px">
		<input id="recherche" type="text" name="recherche" placeholder="recherche">
	</div>
	<input type="submit" value="Ajouter" id="ajouter">
</form>

<p>Tags:</p>
<ul id="tags"></ul>

<hr>

<h2>Resultat de la recherche</h2>
<div id="affichage"></div>


<script>

	let rechercher = () => {
		let inputElement = document.querySelector('#recherche').value

		// Cree la recherche => aliment,aliment2,aliment3
		let chaineRecherche = ""
		tags.forEach(tag => chaineRecherche += (tag + ","))
		chaineRecherche = chaineRecherche.slice(0, -1)

		let recherche = fetch('index.php?page=rechercher&q=' + chaineRecherche)
		.then(response => response.json())
		.then(json => {

			let html = "<ul>"
			Object.keys(json).forEach(j => {
				html += "<li><a href='index.php?page=voir_recette&id=" + j + "'>" + json[j] + "</a></li>"
			})

			document.querySelector('#affichage').innerHTML = html
		})
	}


	let tags = []

	let ajouter = function(event) {
		event.preventDefault();

		let input = document.querySelector('#recherche')

		if (recherche.value != "" && tags.indexOf(input.value) == -1) {
			tags.push(recherche.value)
		}

		rechercher();

		input.value = ""

		// On affiche
		let html = ""
		tags.forEach(el => html += "<li class='tag'>" + el + "</li>")
		document.querySelector('#tags').innerHTML = html

		document.querySelectorAll('.tag').forEach(tag => {

			let supprimer = function(event) {

				tags = tags.filter(el => el != event.target.innerHTML)

				// On reaffiche tags
				let html = ""
				tags.forEach(el => html += "<li class='tag'>" + el + "</li>")
				document.querySelector('#tags').innerHTML = html
				rechercher()

				document.querySelectorAll('.tag').forEach(tag => {
					tag.addEventListener('click', supprimer)
				})

			}

			tag.addEventListener('click', supprimer)
		})


	}

	document.querySelector('#ajouter').addEventListener('click', ajouter)
	document.querySelector('#recherche').addEventListener('keyup', function(event) {
		if(event.keyCode == 13) { // Bouton entre
			ajouter(event)
		}
	})

	function autocomplete(champsDeRecherche, arr) {
		var elementCourant
		champsDeRecherche.addEventListener("input", function(e) {
			let a, el, i, val = this.value
			fermerToutesLesListes()
			if (!val) { return false}
				elementCourant = -1
			a = document.createElement("DIV")
			a.setAttribute("id", this.id + "autocomplete-list")
			a.setAttribute("class", "autocomplete-items")
			this.parentNode.appendChild(a)
			for (i = 0; i < arr.length; i++) {
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					el = document.createElement("DIV")
					el.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>"
					el.innerHTML += arr[i].substr(val.length)
					el.innerHTML += "<input type='hidden' value='" + arr[i] + "'>"
					el.addEventListener("click", function(e) {
						champsDeRecherche.value = this.getElementsByTagName("input")[0].value
						fermerToutesLesListes()
					})
					a.appendChild(el)
				}
			}
		})
		champsDeRecherche.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list")
			if (x) x = x.getElementsByTagName("div")
				if (e.keyCode == 40) {
					elementCourant++
					mettreActif(x)
				} else if (e.keyCode == 38) {
					elementCourant--
					mettreActif(x)
				} else if (e.keyCode == 13) {
					e.preventDefault()
					if (elementCourant > -1) {
						if (x) x[elementCourant].click()
					}
			}
		})
		function mettreActif(x) {
			if (!x) return false
				supprimerActif(x)
			if (elementCourant >= x.length) elementCourant = 0
				if (elementCourant < 0) elementCourant = (x.length - 1)
					x[elementCourant].classList.add("autocomplete-active")
			}
			function supprimerActif(x) {
				for (var i = 0; i < x.length; i++) {
					x[i].classList.remove("autocomplete-active")
				}
			}
			function fermerToutesLesListes(elements) {
				var x = document.getElementsByClassName("autocomplete-items")
				for (var i = 0; i < x.length; i++) {
					if (elements != x[i] && elements != champsDeRecherche) {
						x[i].parentNode.removeChild(x[i])
					}
				}
			}
			document.addEventListener("click", function (e) {
				fermerToutesLesListes(e.target)
			})
		}

		let donnees = <?= '["' . implode('", "', $ingredients) . '"]' ?>

		let donneesPas = donnees.map(donnee => "Pas de " + donnee.toLowerCase())

		donnees = donnees.concat(donneesPas)

		autocomplete(document.querySelector('#recherche'), donneesPas)
	</script>
