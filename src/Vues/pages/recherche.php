<?php $titre = "Page de recherche" ?>

<h1>Page de recherche</h1>

<form autocomplete="off" action="#">
	<div class="autocomplete" style="width:300px">
		<input id="recherche" type="text" name="recherche" placeholder="recherche">
	</div>
	<input type="submit" value="Ajouter" id="ajouter">
</form>

<div id="affichage"></div>

<div id="tag"></div>

<script>

	let afficherAliments = (inputElement) => {
		if(!inputElement.value) {
			document.querySelector('#affichage').innerHTML = ''
			return 0
		}

		let recherche = fetch('index.php?page=rechercher&q=' + inputElement.value)
		.then(response => response.json())
		.then(json => {

			let html = "<ul>"
			Object.keys(json).forEach(j => {
				html += "<li><a href='index.php?page=voir_recette&id=" + j + "'>" + json[j] + "</a></li>"
			})

			document.querySelector('#affichage').innerHTML = html
		})
	}

	document.querySelector('#recherche').addEventListener('keyup', event => {
		afficherAliments(event.target)
	})



	let tags = []
	document.querySelector('#ajouter').addEventListener('click', function(event) {
		event.preventDefault();

		let recherche = document.querySelector('#recherche')
		tags.push(recherche.value)
		//recherche.value = ""

	})

	function autocomplete(inp, arr) {
		var currentFocus
		inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value
			closeAllLists()
			if (!val) { return false}
				currentFocus = -1
			a = document.createElement("DIV")
			a.setAttribute("id", this.id + "autocomplete-list")
			a.setAttribute("class", "autocomplete-items")
			this.parentNode.appendChild(a)
			for (i = 0; i < arr.length; i++) {
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					b = document.createElement("DIV")
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>"
					b.innerHTML += arr[i].substr(val.length)
					b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>"
					b.addEventListener("click", function(e) {
						inp.value = this.getElementsByTagName("input")[0].value
						closeAllLists()
					})
					a.appendChild(b)
				}
			}
		})
		inp.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list")
			if (x) x = x.getElementsByTagName("div")
				if (e.keyCode == 40) {
					currentFocus++
					setActive(x)
				} else if (e.keyCode == 38) {
					currentFocus--
					setActive(x)
				} else if (e.keyCode == 13) {
					e.preventDefault()
					if (currentFocus > -1) {
						if (x) x[currentFocus].click()
					}
			}
		})
		function setActive(x) {
			if (!x) return false
				removeActive(x)
			if (currentFocus >= x.length) currentFocus = 0
				if (currentFocus < 0) currentFocus = (x.length - 1)
					x[currentFocus].classList.add("autocomplete-active")
			}
			function removeActive(x) {
				for (var i = 0; i < x.length; i++) {
					x[i].classList.remove("autocomplete-active")
				}
			}
			function closeAllLists(elmnt) {
				var x = document.getElementsByClassName("autocomplete-items")
				for (var i = 0; i < x.length; i++) {
					if (elmnt != x[i] && elmnt != inp) {
						x[i].parentNode.removeChild(x[i])
					}
				}
			}
			document.addEventListener("click", function (e) {
				closeAllLists(e.target)
				afficherAliments(document.querySelector('#recherche'))
			})
		}

		autocomplete(document.querySelector('#recherche'), <?= '["' . implode('", "', $ingredients) . '"]' ?>)
	</script>
