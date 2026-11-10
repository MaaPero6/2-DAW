# Despliegue de aplicaciones web - Tema 2: Configuración y administración de servidores web

## 📌 Resumen Ejecutivo y Objetivos

Toda página web tiene detrás un servidor que la ofrece: a los internautas, a los empleados de una empresa o a cualquier equipo con conexión de red. Ese servidor debe estar disponible 24x7 y su configuración depende del contenido: no es igual para páginas estáticas que dinámicas, ni cuando se exige confidencialidad o control de acceso.

La elección condiciona la administración. Un servidor modular permite añadir o quitar características sin reinstalar; uno no modular obliga a desinstalar e instalar de nuevo para, por ejemplo, pasar de servir sólo páginas estáticas a dinámicas. A ello se suman escalabilidad, estabilidad ante conexiones simultáneas y la necesidad de probar y registrar lo acontecido; por eso la unidad se centra en Apache (apache2).

Objetivos: recorrido de una petición HTTP/HTTPS, contenido estático y dinámico, tipos MIME, hosts virtuales, módulos, SSL/TLS con certificados y PKI, autenticación básica y LDAP, logs CLF con rotación y despliegue de una aplicación.

## 📖 Desarrollo Teórico Detallado

### 1. Funcionamiento de un servidor web

María reúne al equipo para fijar requisitos, entregables y fechas: recursos y conectividad del servidor, servidor web elegido y requisitos de las aplicaciones. El tema responde a preguntas como por qué al escribir una dirección se visiona una página, por qué no se accede a determinadas páginas, cómo se restringe el acceso por directorio o usuario y cómo se logra una comunicación segura en una transacción bancaria.

### 1.1 Servicio de ficheros estáticos

Una página es estática no porque nunca se modifique —un manual actualizado sigue siéndolo—, sino porque al acceder no interviene código del lado del servidor (PHP) ni del cliente (JavaScript). Es el caso más simple de configurar y el más beneficioso en rendimiento: sin ejecución de código se consume menos CPU y memoria y basta soporte html/xhtml/css, sin PHP. La instalación en Debian 6 crea:

```
/etc/apache2/{apache2.conf, conf.d, envvars, httpd.conf, magic,
             mods-available, mods-enabled, ports.conf,
             sites-available, sites-enabled}
/etc/apache2/sites-available/{default, default-ssl}
/var/www/index.html
/etc/apache2/mods-available/mime.conf
```

`/var/www/index.html` se referencia desde `default`. Para servir una sola página se sustituye `index.html` conservando ese nombre y se actualiza con F5; si se sirve `empresa.html`, coexisten ambas.

### 1.2 Contenido dinámico

El contenido es dinámico cuando depende del código ejecutado en servidor o cliente: cambia según el usuario, produce un efecto al presionar una imagen o varía según el navegador. Consume más CPU y memoria, complica la administración y amplía la superficie de problemas de seguridad. Módulos implicados: `mod_actions`, `mod_cgi`, `mod_cgid`, `mod_ext_filter`, `mod_include`, `mod_ldap`, `mod_perl`, `mod_php5` y `mod_python`.

### 1.3 Protocolo HTTP y HTTPS

HTTP envía la información en texto claro: cualquiera que acceda a la transferencia ve el contenido. HTTPS exige certificados y, si son validados, cifra mediante SSL/TLS, que aporta autenticación y privacidad, a costa de tiempo de computación y rendimiento.

En HTTP se traduce el dominio por DNS a una IP, se busca en ella el servidor que aloja la página en el puerto 80 y se transfiere. En HTTPS se busca el 443 y, antes de transferir, se inicia una negociación SSL en la que el servidor envía su certificado; si lo firma una Entidad Certificadora de confianza se acepta y se cifra la comunicación. Los puertos pueden cambiarse, pero entonces deben escribirse en la URL (`http://www.tupagina.local:8080`, `https://www.tupagina.local:4333`); escribir `:80` equivale a omitirlo, igual que `:443`, y HTTPS no excluye a HTTP.

### 1.4 Tipos MIME

MIME (*Multipurpose Internet Mail Extensions*) especifica cómo transferir texto, imagen, audio, vídeo o cualquier contenido no codificado en US-ASCII (RFC 2045, 2046, 2047, 4288, 4289 y 2077). El servidor confirma que la página existe y su tipo de datos, y lo comunica en `Content-Type` (`text/html`). Cada identificador tiene categoría (`text`) y tipo específico (`html`) y puede indicarse en el servidor, la página o el navegador.

```
<link href="./miarchivo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/mijavascript.js">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
```

El navegador anuncia qué acepta en `Accept` (`*/*` significa cualquier tipo).

| Tipo MIME | Contenido |
|---|---|
| `text/html` | Página web estándar |
| `text/css` | Hoja de estilo |
| `text/javascript` | Código JavaScript |
| `text/plain` | Texto plano (`DefaultType`) |
| `image/gif` | Imagen GIF (`ForceType`) |
| `video/mp4` | Vídeo MP4 (`ForceType`) |

### 1.4.1 Configurar el servidor para enviar los tipos MIME correctos

`DefaultType` asigna `Content-Type` a cualquier archivo cuyo MIME no pueda determinarse por la extensión; `ForceType` hace que los ficheros con equivalencia se sirvan como el tipo establecido.

```
DefaultType text/plain
DefaultType text/html
ForceType image/gif
ForceType video/mp4
```

Así, el navegador despliega el contenido como texto, HTML, imagen GIF o vídeo MP4. `/etc/apache2/mods-available/mime.conf` referencia `/etc/mime.types`, la lista de tipos reconocidos.

### 2. Hosts virtuales

Para alojar dominios distintos en un mismo servidor se configuran hosts virtuales o *virtualhosts* (`empresa1.com` … `empresaN.com`). Cada uno es independiente, pero lo no incluido en su definición se hereda de `apache2.conf`, como `Timeout 300`, que fija en 300 segundos el tiempo antes de cancelar una conexión sin respuesta. Hay tres tipos: por nombre, por IP y por varios servidores principales. Sin DNS pueden crearse entradas en `/etc/hosts`:

```
#IP nombre-dominio
192.168.200.250 empresa1.com www.empresa1.com
192.168.200.250 empresa2.com www.empresa2.com
```

### 2.1 Virtualhosts basados en nombre

La IP de la definición es la del servidor (`IP_Servidor_Web=192.168.200.250`) y cada *virtualhost* ocupa un fichero en `/etc/apache2/sites-available`:

```
<VirtualHost IP_Servidor_Web:80>
DocumentRoot /var/www/empresa1/
ServerName www.empresa1.com.
ServerAlias empresa1.com empresa1.es www.empresa1.es
</VirtualHost>
```

El puerto 80 es el HTTP por defecto fijado con `Listen`, por lo que puede omitirse. `DocumentRoot` fija la ruta de la página, `ServerName` el nombre DNS y `ServerAlias` otros nombres para la misma página.

### 2.2 Virtualhosts basados en IP

Cada IP corresponde a una interfaz del servidor (`192.168.200.250`, `192.168.200.251`). El procedimiento es idéntico y sólo cambian los ficheros, que usan `IP1_Servidor_Web:80` y `IP2_Servidor_Web:80`. No aporta ventajas sobre el anterior y es más difícil de mantener si las IP cambian.

### 2.3 Virtualhosts basados en varios servidores principales

Es el método más complejo y sólo tiene sentido con varios `apache2.conf` independientes, cada uno con sus hosts virtuales.

### 3. Módulos

La importancia de un servidor web radica en su estabilidad, disponibilidad y escalabilidad: soporte SSL es módulo SSL; PHP, módulo PHP; LDAP, módulo LDAP. En Debian, `a2enmod` habilita un módulo creando un enlace desde `/etc/apache2/mods-enabled/` hacia `/etc/apache2/mods-available/`, y `a2dismod` lo deshabilita eliminándolo; sin esos comandos se crean o borran los enlaces a mano. `a2ensite` habilita sitios desde `sites-available` enlazándolos en `sites-enabled`.

### 3.1 Operaciones sobre módulos

Un módulo puede estar instalado y no habilitado: hasta habilitarlo no funciona.

| Operación | Comando | Ejemplo con ssl |
|---|---|---|
| Instalar | `apt-get install nombre-modulo` | `apt-get install libapache2-mod-gnutls` |
| Desinstalar | `apt-get remove nombre-modulo` | `apt-get remove libapache2-mod-gnutls` |
| Habilitar | `a2enmod nombre-modulo-apache` | `a2enmod ssl` |
| Deshabilitar | `a2dismod nombre-modulo-apache` | `a2dismod ssl` |

Los cambios se reconocen al recargar:

```
/etc/init.d/apache2 restart
# o bien, si la configuración es correcta:
/etc/init.d/apache2 reload
```

Sin los comandos Debian, se crean en `mods-enabled` enlaces `ln -s` a `ssl.conf` y `ssl.load`, o se borran con `rm -f`, y se recarga.

### 4. Acceso a carpetas seguras

No todas las páginas deben ser accesibles por cualquiera, pero asegurar la información implica cifrado y mayor consumo por computación. Se emplea cifrado asimétrico o de clave pública: la kpub se publica y la kpriv sólo la posee su dueño; lo cifrado con kpub sólo se descifra con kpriv, y lo cifrado con kpriv sólo con kpub. El navegador (A) cifra con la kpub de B, obtenida de un certificado digital, y B descifra con su kpriv, lo que garantiza la confidencialidad; la autenticidad, con certificados de AC de confianza (Verisign, Thawte).

### 4.1 Certificados digitales, AC y PKI

Un certificado digital asocia una clave pública con la identidad de su propietario —individuo o máquina, por ejemplo un servidor web— y lo firma con su clave privada una autoridad de confianza. Los extremos confían entre sí si ambos se relacionan con una tercera parte que da fe de su fiabilidad. Esa Tercera Parte Confiable (TPC/TTP) es la Autoridad de Certificación (AC), base de las Infraestructuras de Clave Pública (ICP/PKI). Servicios: registro, revocación, publicación de claves, evaluación de la confianza y recuperación. La PKI la componen la AC, que firma y gestiona la lista de revocados, y la Autoridad de Registro (AR), que recibe solicitudes, comprueba los datos y las traslada a la AC. El formato habitual es UIT-T X.509, con campos como versión, número de serie, emisor, periodo de validez, sujeto, clave pública del sujeto y extensiones.

### 4.2 Módulo ssl para Apache

El módulo ssl cifra la información entre navegador y servidor usando clave pública para autenticar el servidor; no viene activado por defecto y se habilita con `a2enmod ssl`, proporcionando SSL v2/v3 y TLS v1 sobre OpenSSL. Para deshabilitarlo, `a2dismod ssl` y recarga; sin el comando, se eliminan `ssl.conf` y `ssl.load` de `mods-enabled`.

### 4.3 Crear un servidor virtual seguro en Apache

`/etc/apache2/sites-available/default-ssl` trae la configuración SSL por defecto:

```
SSLEngine on
SSLCertificateFile /etc/ssl/certs/ssl-cert-snakeoil.pem
SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key
```

`SSLEngine on` activa SSL, `SSLCertificateFile` indica el certificado y `SSLCertificateKeyFile` su clave privada: Apache admite SSL y posee un certificado autofirmado por sí mismo, ya que actúa como CA. Firefox avisa de que el certificado no lo firma una AC de su lista (`sec_error_untrusted_issuer`); el usuario puede añadir una excepción —y la información viaja cifrada— o rechazar la conexión. Para generar un certificado de pruebas:

```
apt-get install openssl
mkdir /etc/apache2/tus-ssl/
make-ssl-cert /usr/share/ssl-cert/ssleay.cnf /etc/apache2/tus-ssl/apache.pem
```

Se indica el DNS de la IP (`autofirmado.ssl.empresa-proyecto.com`), resoluble por DNS o `/etc/hosts`; el `.pem` contiene certificado y clave. Se edita `default-ssl` apuntando ambos parámetros al `.pem`, se comprueba `Listen 443` en `ports.conf` y se ejecuta `a2enmod ssl`, `a2ensite default-ssl` y `/etc/init.d/apache2 restart`. La negociación SSL depende de la IP, no del nombre: no pueden servirse certificados distintos en una misma IP.

### 4.4 Comprobar el acceso seguro al servidor

Si el certificado no es admitido, deben revisarse sus campos antes de crear la excepción y comprobar que la página es la que declara. El candado de la barra de direcciones confirma el acceso por HTTPS.

### 5. Autenticación y control de acceso

Puede interesar impedir el acceso a información confidencial o controlar el acceso a un servicio como el correo. La autenticación suele transferirse a una base de datos, en la misma máquina o en otra, con SQL o LDAP, siendo OpenLDAP habitual. HTTP ofrece el método `basic`: el servidor muestra un diálogo de usuario y contraseña que el cliente reenvía en texto claro, por lo que conviene combinarlo con HTTPS. Es típico usar `.htaccess`, lo que exige `AllowOverride AuthConfig`; también puede controlarse el acceso por IP.

### 5.1 Autenticar usuarios en Apache mediante LDAP

Apache autentica contra LDAP con los módulos `ldap` y `authnz_ldap`, habilitados con `a2enmod authnz_ldap` y un reinicio. El *virtualhost* define `DocumentRoot`, `ServerName www.empresa-proyecto.panel-de-control.com`, `ErrorLog` y `CustomLog` propios, y `<Directory …> AllowOverride All </Directory>`, necesario para `.htaccess`. El fichero `.htaccess` contiene:

```
AuthName "Autenticacion por LDAP"
AuthType Basic
AuthBasicProvider ldap
AuthzLDAPAuthoritative on
AuthLDAPUrl ldap://127.0.0.1/ou=usuarios,dc=proyecto,dc=com?uid
Require ldap-user user1LDAP
```

`Require ldap-user` permite el acceso a ese usuario; los demás quedan denegados.

### 6. Monitorización del acceso: archivos de registro

Comprobar el funcionamiento del servidor exige logs, que según la LSSI/CE deben conservarse al menos un año por requerimientos judiciales. Apache los crea en formato CLF (*Common Logon Format*): cada línea es una solicitud con campos separados por espacios, y un campo sin valor se marca con guión:

```
192.168.200.100 - - [05/May/2011:17:19:18 +0200] "GET /index.html HTTP/1.1" 200 20
```

| Campo (especificador) | Definición | Ejemplo |
|---|---|---|
| host (`%h`) | Equipo cliente que solicita | 192.168.200.100 |
| ident (`%l`) | Cliente con identd y `IdentityCheck` activa | - |
| authuser (`%u`) | Usuario si la URL requiere autenticación | - |
| date (`%t`) | Fecha y hora entre corchetes | [05/May/2011:17:19:18 +0200] |
| request (`%r`) | Petición del cliente | /index.html |
| status (`%s`, `%>s`) | Código de estado HTTP de tres dígitos | 200 |
| bytes (`%b`) | Bytes devueltos sin cabeceras | 20 |

El campo `status` distingue las páginas servidas de las inexistentes:

| Código | Significado |
|---|---|
| 200 | Petición correcta: página servida |
| 404 | Recurso no encontrado: página inexistente |

### 6.1 Directivas para archivos de registro

Se aplican tanto en la configuración principal como en los hosts virtuales:

| Directiva | Definición |
|---|---|
| `TransferLog` | Archivo o programa de destino; usa los especificadores de `LogFormat` |
| `LogFormat` | Define el formato del archivo asignado con `TransferLog` |
| `ErrorLog` | Registra los errores de Apache, en archivo o en `syslog` |
| `CustomLog` | Como `TransferLog`, con formato personalizable |
| `CookieLog` | Archivo donde registrar información sobre cookies |

```
CustomLog logs/acceso_a_empresa1.log
```

### 6.2 Rotación de los archivos de registro

Como los logs crecen, deben depurarse, comprimirse y guardarse, conservando al menos un año. Hay dos opciones: `rotatelogs`, de Apache, y `logrotate`, presente en la mayoría de sistemas GNU/Linux.

```
CustomLog "|/usr/sbin/rotatelogs /var/log/apache2/access.log 86400" common
CustomLog "|/usr/sbin/rotatelogs /var/logs/apache2/access.log 5M" common
ErrorLog "|/usr/sbin/rotatelogs /var/logs/errorlog.%Y-%m-%d-%H_%M_%S 5M" common
```

El primero rota cada 24 horas; el segundo, al llegar a 5 MB; el tercero, por tamaño y con sufijo de fecha y hora.

### 6.2.1 Rotación con logrotate

`logrotate` rota, comprime y envía registros por día, semana, mes o tamaño, en una tarea diaria del cron. `/etc/logrotate.conf` define lo global y `/etc/logrotate.d/apache2` lo de apache2.

```
/usr/sbin/logrotate -d /etc/logrotate.d/apache2   # comprobar configuración
/usr/sbin/logrotate -f /etc/logrotate.conf        # forzar ejecución
```

`/etc/cron.daily/logrotate` ejecuta la tarea a diario (`test -x /usr/sbin/logrotate || exit 0` y `/usr/sbin/logrotate /etc/logrotate.conf`), y puede añadirse al crontab: `0 03 * * * root /usr/sbin/logrotate /etc/logrotate.conf > /dev/null 2>&1`.

### 7. Despliegue de aplicaciones sobre servidores web

Las aplicaciones web necesitan soporte PHP y SQL; el SQL puede ofrecerlo otro servidor, en el mismo equipo o en otro. El procedimiento: descargar la aplicación, hacerla visible a través del servidor (suele incluir una página que verifica requisitos), autenticarse al servidor SQL con permisos para crear o modificar la base de datos, indicar usuario y contraseña y finalizar. Destacan OpenCart, Magento y osCommerce.

## 💡 Ejemplos Prácticos y Aplicaciones

### Caso 1: siete sucursales con hosts virtuales y panel seguro

Se necesitan aplicaciones en `www.sucursal-zonaX.empresa-proyecto.com` (X de 1 a 7), también sin `www`, y un panel único en `www.empresa-proyecto.panel-de-control.com` con contenido según perfil. María opta por hosts virtuales, Juan exige HTTPS para el panel y Antonio prueba por HTTP y HTTPS. Se crea un fichero por sitio en `sites-available` con `DocumentRoot` propio y `ServerAlias` sin `www` —las tres URL son dos sitios, luego dos ficheros—, se añaden entradas en `/etc/hosts`, se activan con `a2ensite` y se recarga.

### Caso 2: servidor seguro con certificado autofirmado

Se genera el certificado con `make-ssl-cert`, se apunta `default-ssl` al `.pem`, se verifica `Listen 443`, se habilitan `ssl` y `default-ssl` y se reinicia. El cliente abre la URL, revisa el certificado, acepta la excepción y comprueba el candado.

### Caso 3: despliegue de OpenCart

Requisitos: Apache, PHP 5.2 o superior, MySQL, Curl y Fsock.

```
mkdir /tmp/pruebas && cd /tmp/pruebas
wget -c http://opencart.googlecode.com/files/opencart_v1.4.9.5.zip
apt-get install unzip && unzip opencart_v1.4.9.5.zip
```

Se crea el *virtualhost* `tienda-virtual` con `DocumentRoot /var/www/tienda-virtual`, se mueve allí `upload`, se activa con `a2ensite tienda-virtual` y se recarga Apache; se dan permisos `0755` o `0777` a `image/`, `system/cache/`, `system/logs/`, `download/`, `config.php` y `admin/config.php`. La base de datos se crea con un usuario distinto de root:

```
/usr/bin/mysql -h127.0.0.1 -uroot -p -e "CREATE DATABASE db_opencart;"
/usr/bin/mysql -h127.0.0.1 -uroot -p -e "GRANT SELECT,UPDATE,INSERT,DELETE,DROP,INDEX,ALTER,CREATE ON \"db_opencart\".* TO \"db_user_opencart\"@localhost IDENTIFIED BY 'opencart';"
/usr/bin/mysql -h127.0.0.1 -uroot -p -e "flush privileges;"
```

Se visita `http://www.tienda-virtual.empresa-proyecto.com/`, se siguen las instrucciones y se borra `install`; la tienda queda en la raíz y la administración en `/admin/`.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

### Conceptos clave

1. **Estático vs. dinámico**: sin código en servidor ni cliente frente a contenido dependiente de usuario o base de datos.
2. **Puertos 80 y 443**: puertos TCP por defecto de HTTP y HTTPS; omitirlos equivale a escribirlos.
3. **Negociación SSL**: validación del certificado antes de transferir; depende de la IP.
4. **Tipo MIME**: identificador `categoría/tipo` enviado en `Content-Type`; se define en servidor, página y navegador.
5. **`DefaultType`/`ForceType`**: tipo por defecto para archivos no identificables y tipo forzado para varios ficheros.
6. **Host virtual**: permite varios dominios en un servidor (por nombre, IP o varios servidores principales).
7. **Herencia**: lo no definido en un *virtualhost* se toma de `apache2.conf`.
8. **`a2enmod`/`a2dismod`/`a2ensite`**: habilitan módulos y sitios con enlaces entre `available` y `enabled`.
9. **AC, AR y PKI**: quien firma certificados, quien recibe solicitudes y la infraestructura que las integra (X.509).
10. **CLF y rotación**: log común con campos `%h %l %u %t %r %s %b`, conservado un año y rotado con `rotatelogs` o `logrotate`.

### Preguntas de autoevaluación

**1. ¿Qué diferencia una página estática de una dinámica?**
La estática no requiere código del servidor ni del cliente; puede actualizarse y seguir siéndolo. La dinámica depende de código en servidor o cliente, del usuario, del navegador o de una base de datos. Un manual HTML/CSS es estático; un panel con perfiles, dinámico.

**2. ¿Qué ocurre desde que se escribe una URL HTTP hasta que se ve la página?**
Se traduce el dominio por DNS a una IP, se busca el servidor que aloja la página en el 80 y se transfiere. En HTTPS se usa el 443 y antes se negocia SSL.

**3. ¿Puede servirse HTTPS en otro puerto? ¿Qué implica?**
Sí, por ejemplo `https://www.tupagina.local:4333`; implica que el usuario debe escribir el puerto en la URL. HTTP puede igualmente moverse al 8080.

**4. ¿Dónde se indica el tipo MIME y cómo llega al navegador?**
En el servidor, en la página (`link`, `script`, `object`, `form`, `meta`) y en el navegador, que anuncia lo que acepta en `Accept`. El servidor lo comunica en `Content-Type`; si falta, se deduce por la extensión del archivo.

**5. ¿Para qué sirven `DefaultType` y `ForceType`?**
`DefaultType` asigna `Content-Type` a los archivos sin MIME determinable por extensión (`DefaultType text/plain`); `ForceType` sirve un conjunto de ficheros con el tipo indicado (`ForceType image/gif`).

**6. Si un *virtualhost* no define `Timeout`, ¿qué valor se aplica?**
El de `apache2.conf`, `Timeout 300`; toda directiva ausente se hereda de la configuración principal, de modo que las comunes se definen una sola vez.

**7. ¿Qué tipos de *virtualhost* hay y cuál es menos recomendable?**
Por nombre, por IP y por varios servidores principales. El de IP no aporta ventajas sobre el de nombre y es difícil de mantener si las IP cambian; el de varios servidores sólo procede con varios `apache2.conf`.

**8. ¿Qué diferencia hay entre instalar y habilitar un módulo?**
Instalar copia el módulo (`apt-get install libapache2-mod-gnutls`); habilitar crea el enlace en `mods-enabled` (`a2enmod ssl`). Un módulo instalado y no habilitado no funciona hasta habilitarlo y recargar Apache.

**9. ¿Por qué un certificado autofirmado provoca un aviso y cuándo es aceptable?**
Porque no lo firma una AC de la lista del navegador (`sec_error_untrusted_issuer`). Es aceptable en sitios internos o restringidos, o asumiendo el riesgo; en un sitio público el usuario probablemente rechazará la conexión.

