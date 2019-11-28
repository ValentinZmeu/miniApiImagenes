
# Uso de la api
Las llamadas a la api acepta cualqueir tipo de parametros [POST y GET]. Para añadir un plugin nuevo se debe añadir la clase en el directorio **plugins** y añadirlo en conf.php.

---

Cada plugin se llama en la propia petición. Todos los plugins deben tener una función **start($options)** que se usará como punto de entrada e inicio de su funcionalidad.

--- 

A continuación dejo los ejemplos del uso de los plugins. Se debe tener en cuenta que **http://localhost/zankyou** es la ruta base del proyecto (se puede modificar en el config.php)

http://localhost/zankyou/SizeEditor/CoolBlur?blur_size=200&resize=100
* En esta llamada se llamarán las librerías SizeEditor y CoolBlur.
* Los parametros blur_size (CoolBlur) y resize (SizeEditor) se usarán cada uno en su propia librería

http://localhost/zankyou/CoolBlur?blur_size=200&resize=100
* En este caso el parametro *resize* se ingorará ya que no se usa en la libreria CoolBlur

http://localhost/zankyou/SizeEditor/CoolBlur
* En este caso, las librerías se llaman con los valores de por defecto (los especificados en el fichero conf.php)



