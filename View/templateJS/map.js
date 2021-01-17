//seleciona id map
let $map=document.querySelector('#map')

class GoogleMap
{
	constructor()
	{

		this.map=null
		// añadir marker a una caja
		this.bounds=null
		//guardamos la class textmarker en una variable de instancia
		this.textMarker=null
	}
	/**
	* carga el mapa sobre un elemento
	*@param{HTMLElement}
	*/
	async load(element){
		//El objeto Promise (Promesa) es usado para computaciones asíncronas. 
		//Una promesa representa un valor que puede estar disponible ahora, en el futuro, o nunca.
		return new Promise((resolve,reject)=>{
	//=> para que haga referencia al constructor
	$script("https://maps.googleapis.com/maps/api/js?key=AIzaSyAhS3viROB_tPYZ-MFSW1CHLpV9Mxxnyus",() => {
		//declaramos la class para modificar los marker de google:
		//objeto hereda de google.maps.OverLayView
		//The Maps JavaScript API provides an OverlayView class for creating your own custom overlays
		//https://developers.google.com/maps/documentation/javascript/customoverlays
		this.textMarker=class TextMarker extends google.maps.OverlayView {

		constructor (pos, map, text) {
			//constructor padre
			super()
			this.html = null;
			this.div  = null
			this.pos  = pos
			this.text = text
			//assignamos el overlay a nuestro mapa
			this.setMap(map)
			//necesitamos saber cuando el elmento html(al hacer click) es activado para ello añadimos un callBack
			this.onActivation=[]
		}
			//al añadir el elemnto
		onAdd () {
			this.div = document.createElement('div')
			//damos un class al marker para el css
			this.div.classList.add('marker')
			//overlay sigue el movimiento del mapa
			this.div.style.position = 'absolute'
			this.div.innerHTML = this.text
			this.getPanes().overlayImage.appendChild(this.div)
			//al hacer click en mi elemento se añade el contenido de mi html
			this.div.addEventListener('click',(e)=>{
			//para impedir los datos google
				e.preventDefault()
				e.stopPropagation()
				//cambiamos el contenido para mostrar el contenido del metodo setContent
				//lo mismo que this.div.innerHTML=this.html
				this.activate()
			})
		}

		draw () {
		//el elemnto marker se queda en su posicion en el mapa
		//Computes the pixel coordinates of the given geographical location in the DOM element that holds the draggable map.
		//https://developers.google.com/maps/documentation/javascript/reference/overlay-view
			let position = this.getProjection().fromLatLngToDivPixel(this.pos)
			this.div.style.left = position.x + "px"
			this.div.style.top = position.y + "px"
		}

		onRemove () {
			this.div.parentNode.removeChild(this.div)
		}

			//se crea 2 metodos más: active y non-active segun el focus del elemnto
		hover(){
			if(this.div!==null){
			//class is-active ->style.css (372)
				this.div.classList.add('is-active')
			}
		}
		hoverOut(){
			if(this.div!==null){
				this.div.classList.remove('is-active')	
			}
		}

		activate(){
			if(this.div!==null){
				this.div.innerHTML=this.html
				if(this.div.innerHTML!==null){
					this.div.classList.add('cuadroMapa')
				}			
			}
		//les llamamos uno tras otro
			this.onActivation.forEach ( function(cb) 
				{ 
					cb() 	
				});
			}

		desactivate(){
			if(this.div!==null){
				this.div.innerHTML=this.text
			}
		}
		//parametro una cadena de texto que sera el contenido
		setContent(html){
			this.html=html;
		}
	}
		//let center={lat:-25.363,lng:131.044}
		this.map = new google.maps.Map(element)
		//	posicionamos el marker
		this.bounds= new google.maps.LatLngBounds() 
		//se genera una vez que se ha cargado todo
		resolve()
		})	
	})
}

	/**
	Añadir un marker en el mapa
	*@param{string}  lat
	*@param{string}  lng
	*@param{string}  text
	*/
	addMarker(lat,lng,text){
	//parametros de longitud y latitud
	//A LatLng is a point in geographical coordinates: latitude and longitude.
	let point = new google.maps.LatLng(lat,lng)
	//parametros : la posicion/el mapa/el texto
	let marker = new this.textMarker(point,this.map,text)
	// añado en los callBack un nuevo callBack
	marker.onActivation.push(()=>{
		this.map.setCenter(marker.pos)
	})
	//cada vez que se añade un marker, hacemos un extend del punto
	//para crear una clase hija de otra.
	this.bounds.extend(point)
		//tenemos que devolver marker para utilizarlo en la class activ
		return marker;
	}

	//metodo para centrar el mapa
	centerMap(){
		this.map.panToBounds(this.bounds)
		this.map.fitBounds(this.bounds)
	}
}

const initMap = async function(){
	
	let map = new GoogleMap()
	let activeMarker=null
	//para esconder el elemnto html (onclick)
	let enableMarker=null
	//cargamos el mapa
	await map.load($map)
//una vez que el mapa esta cargado, seguimos.
	//recojemos los elementos con la class item
	Array.from(document.querySelectorAll('.item')).forEach(function(item)
	{
	let marker=	map.addMarker(item.dataset.lat,item.dataset.lng, item.dataset.price+'€')
	//contenido que se muestra en el mapa al hacer click
	//llamamos al metodo setContent
	marker.setContent(item.innerHTML)
	//para activar y desactivar el elemento html
	marker.onActivation.push(function(){
			//desactivar marker
			if(enableMarker!==null){
				enableMarker.desactivate()
			}
			enableMarker=marker
		})
		//Para mostrar en el mapa el element item selecionado
		item.addEventListener('mouseover', function(){
			marker.hover()
			//desactivar marker
			if(activeMarker!==null){
				activeMarker.hoverOut()
			}
			activeMarker=marker
		})
		item.addEventListener('mouseleave', function(){
			if(activeMarker===marker)
				marker.hoverOut();
			//para hacer como un reset de la class active y reiniciarla.
			activeMarker=null;	
		})
	})
	//centramos despues del bucle
	map.centerMap()
}

if($map!=null){
	initMap()
}
