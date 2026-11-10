# Optativa - Gestores de contenido - Tema 1: Introducción al CMS y CDMON

## 📌 Resumen Ejecutivo y Objetivos

La Unidad 1 asienta el vocabulario técnico del curso (CMS, backend, frontend, tema, plugin, permalink) y lo traslada a un entorno real mediante la instalación de WordPress en CDMON. El hilo argumental: un CMS separa el contenido de su presentación y permite publicar sin programar; WordPress es el CMS con mayor implantación; CDMON es el hosting donde se despliega; y los permalinks son la primera decisión con consecuencias sobre el SEO. No se pretende formar programadores, sino administradores capaces de desplegar, configurar y justificar la elección de un gestor de contenidos.

| Tipo | Objetivo |
|---|---|
| Conceptual | Definir qué es un CMS y enumerar sus características principales |
| Conceptual | Comparar ventajas y desventajas entre CMS y desarrollo a medida |
| Conceptual | Identificar los diferentes tipos de CMS del mercado |
| Práctico | Realizar una instalación completa de WordPress en CDMON |
| Práctico | Configurar los parámetros básicos del sitio web |
| Práctico | Establecer correctamente los enlaces permanentes |
| Práctico | Verificar el correcto funcionamiento de la instalación |

## 📖 Desarrollo Teórico Detallado

### 1. Definición técnica y características

Un CMS (*Content Management System* o Sistema de Gestión de Contenidos) es una **aplicación web que permite la creación, gestión y modificación de contenido digital sin necesidad de conocimientos técnicos especializados en programación**. Se ejecuta en un servidor y se administra desde el navegador; su objeto es el **contenido digital** (textos, imágenes, páginas, entradas) y su valor diferencial es la **ausencia de programación**: el gestor escribe y el CMS hace el resto.

Características principales:

- **Interfaz intuitiva**: panel de administración amigable.
- **Separación contenido-diseño**: cambiar el diseño no afecta al contenido.
- **Gestión de usuarios**: roles y permisos distintos.
- **Workflow de publicación**: borrador → revisión → publicación.
- **Extensiones**: plugins y temas que amplían funciones y apariencia sin tocar el núcleo.

### 2. Flujo de trabajo y arquitectura

Flujo típico (cadena que conviene memorizar):

**Usuario → Panel Admin → CMS → Base de Datos → Sitio Web publicado**

El usuario introduce contenido en el panel, el CMS lo persiste en la base de datos y genera el sitio que ve el visitante: **el contenido vive en la base de datos, no en los archivos del servidor**.

| Componente | Función |
|---|---|
| Base de datos | Almacena todo el contenido y las configuraciones |
| Backend | Panel de administración para gestionar el contenido |
| Frontend | Parte visible para los visitantes |
| Tema / Plantilla | Define la apariencia visual |
| Módulos / Plugins | Añaden funcionalidades específicas |

La **ventaja clave** es que el usuario solo interactúa con el backend y el CMS compone el frontend: nunca se edita HTML, solo se modifican registros.

### 3. Tipos de CMS

Los criterios no son excluyentes: WordPress es a la vez open source, orientado a blogs y basado en PHP.

**Según licencia.** *Open Source*: WordPress, Joomla, Drupal (gratuitos, código abierto). *Propietarios*: Adobe Experience Manager, Sitecore (de pago, código cerrado).

**Según propósito.** Blogs y webs: WordPress, Ghost. Comercio electrónico: WooCommerce, PrestaShop, Magento. Portales empresariales: Drupal, Liferay. Educación: Moodle, Chamilo.

**Según tecnología.** PHP: WordPress, Joomla, Drupal. .NET: Umbraco, Sitecore. Java: Liferay, OpenCMS.

La tecnología condiciona el hosting: un CMS en PHP requiere PHP y MySQL; uno en .NET exige Windows/IIS.

### 4. WordPress en cifras

El **43,5 %** de todos los sitios web usa WordPress, el **65,1 %** de cuota del mercado de CMS; en español lo emplea el **35 %**. Por tipo: blogs personales 32 %, corporativos 28 %, tiendas online 18 %, portales de noticias 12 %, otros 10 %; predominan publicaciones y webs corporativas, no el comercio electrónico.

Sus razones de popularidad son una comunidad de **más de 100.000 contribuidores**, más de **60.000 plugins gratuitos** y **actualizaciones de seguridad regulares**. La actualización solo es ventaja si se aplica: un WordPress sin actualizar es un WordPress vulnerable.

### 5. CMS frente a desarrollo a medida

| CMS (WordPress) | Desarrollo a medida |
|---|---|
| Rápida implementación | Máxima personalización |
| Coste inicial bajo | Coste más elevado |
| Actualizaciones automáticas | Mantenimiento complejo |
| Comunidad de soporte | Control total del código |
| Limitaciones de diseño | Tiempo de desarrollo mayor |
| Dependencia de plugins | Optimización específica |

Ninguna columna es mejor en abstracto: la elección depende del proyecto.

**Elegir CMS cuando** el presupuesto es limitado, se necesita lanzamiento rápido, el cliente gestiona el contenido y el proyecto es de mediana complejidad. **Elegir desarrollo a medida cuando** hay requerimientos muy específicos, grandes volúmenes de datos y usuarios, integraciones complejas, aplicaciones web complejas (no solo contenido) o máximos requisitos de seguridad y rendimiento.

### 6. CDMON: características y ventajas

Características: **panel de control propio** (desarrollo a medida, no un panel estándar de terceros), **almacenamiento desde 5 GB hasta ilimitado**, **cuentas de correo ilimitadas incluidas**, **certificado SSL gratuito incluido**, **bases de datos MySQL ilimitadas** y **dominio incluido en el plan del curso**.

Ventajas: hospedaje web español, panel intuitivo, **instalador automático de WordPress**, soporte técnico en español y dominio incluido. El instalador evita crear la base de datos y subir archivos por FTP.

### 7. Proceso de instalación de WordPress en CDMON

Se ejecuta íntegramente desde el panel, en seis pasos:

1. **Acceder al panel de control de CDMON.**
2. **Buscar «Instalador de aplicaciones».**
3. **Seleccionar WordPress.**
4. **Elegir dominio y directorio de instalación.** Instalar en la raíz o en un subdirectorio determina la URL pública.
5. **Configurar los datos de administración.** Nombre del sitio, usuario, contraseña y correo.
6. **Completar la instalación automática.** El instalador crea la base de datos, copia los archivos y deja el sitio listo.

### 8. Configuración inicial del sitio

Se accede al escritorio mediante **tudominio.com/wp-admin** y se revisan los ajustes generales:

| Ajuste | Contenido |
|---|---|
| Título del sitio | Nombre oficial de la web |
| Descripción breve | Eslogan o descripción (importante para SEO) |
| Dirección de WordPress | URL de instalación |
| Dirección del sitio | URL pública (normalmente igual) |
| Dirección de correo electrónico | Para notificaciones |
| Miembro desde | Fecha de fundación (opcional) |
| Zona horaria | Europe/Madrid |
| Formato de fecha/hora | Según preferencias locales |

Por qué importa cada campo: **el título aparece en las pestañas y en los resultados de búsqueda**; **la descripción breve puede aparecer en los snippets de Google**, el fragmento bajo el enlace; y **la zona horaria afecta a la programación de publicaciones**, que con una zona errónea salen a otra hora. Las dos direcciones solo difieren si WordPress va en un subdirectorio.

### 9. Enlaces permanentes (permalinks)

Los **permalinks** son la estructura de URLs que apuntan a contenido específico de forma permanente. Evolucionan del parámetro `?p=123` a las estructuras con fecha y nombre (`/2024/09/24/mi-entrada/`) y al nombre de la entrada (`/mi-entrada/`), recomendado para SEO.

Se configuran en **Ajustes → Enlaces permanentes**, con seis opciones:

| Opción | Estructura | Valoración |
|---|---|---|
| Simple | `?p=123` | No recomendado |
| Día y nombre | `/2024/09/24/sample-post/` | Bueno para blogs de noticias |
| Mes y nombre | `/2024/09/sample-post/` | Equilibrado |
| Numérico | `/archives/123` | Poco claro |
| Nombre de la entrada | `/sample-post/` | Mejor para SEO |
| Estructura personalizada | Definida por el usuario | Para usuarios avanzados |

### 10. Importancia SEO de los permalinks

Buenas prácticas para URLs amigables: **incluir palabras clave** (`/marketing-digital/` frente a `/pagina1/`); **estructura lógica** (`/categoria/post-individual/`); **evitar caracteres especiales**, con guiones en lugar de espacios; y **URLs cortas**, con un máximo de 5-6 niveles. El impacto en SEO llega por tres vías: mejor experiencia de usuario, presencia de la URL en los resultados y palabras clave en la URL como factor de ranking.

## 💡 Ejemplos Prácticos y Aplicaciones

### Ejemplo 1: decisión entre CMS y desarrollo a medida

Una clínica dental necesita web con horarios, servicios, blog y formulario, con presupuesto ajustado y la recepcionista publicando sin ayuda técnica: procede un CMS por lanzamiento rápido, coste bajo y complejidad media. Si exigiera integración con su software de historia clínica y miles de pacientes, el criterio cambiaría a desarrollo a medida.

### Ejemplo 2: instalación y verificación

En CDMON: panel → «Instalador de aplicaciones» → WordPress → dominio y raíz → datos de administración → instalación automática. Si `tudominio.com/wp-admin` carga el escritorio, es correcta. Verificación mínima en cuatro pruebas: frontend en el dominio, acceso a `/wp-admin`, certificado SSL activo (https) y URL de una entrada conforme al permalink configurado.

### Ejemplo 3: configuración y permalinks

Una academia fija título «Academia Kursaal», descripción «Formación profesional en informática», zona Europe/Madrid y correo de notificaciones: la descripción puede salir en el snippet de Google y la zona horaria garantiza que una entrada programada a las 9:00 se publique a las 9:00. Antes de publicar se elige «Nombre de la entrada» (`/como-configurar-wordpress-para-seo/`); en un medio de noticias tendría sentido «Día y nombre». La estructura se decide antes de publicar porque cambiarla rompe los enlaces compartidos, y una URL heredada `/pagina1/` se corrige con palabra clave, jerarquía, guiones y 5-6 niveles como máximo.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

### Preguntas de autoevaluación

**1. Define CMS y explica por qué evita la necesidad de programar.**
Es una aplicación web que permite crear, gestionar y modificar contenido digital sin conocimientos técnicos especializados. Evita programar porque el usuario solo actúa sobre el backend y el sistema genera el frontend con los datos y el tema activo.

**2. Enumera las cinco características principales de un CMS.**
Interfaz intuitiva; separación contenido-diseño; gestión de usuarios con roles y permisos; workflow de publicación (borrador, revisión, publicación); y extensiones mediante plugins y temas.

**3. ¿Cuáles son los cinco componentes de la arquitectura de un CMS?**
Base de datos, backend, frontend, tema o plantilla y módulos o plugins: la base de datos guarda contenido y configuraciones; el backend permite gestionarlo; el frontend es lo visible; el tema define la apariencia; los plugins añaden funciones.

**4. Clasifica los CMS según licencia, propósito y tecnología.**
Licencia: open source (WordPress, Joomla, Drupal) y propietarios (Adobe Experience Manager, Sitecore). Propósito: blogs y webs (WordPress, Ghost), e-commerce (WooCommerce, PrestaShop, Magento), portales (Drupal, Liferay) y educación (Moodle, Chamilo). Tecnología: PHP (WordPress, Joomla, Drupal), .NET (Umbraco, Sitecore), Java (Liferay, OpenCMS).

**5. ¿Qué porcentaje de sitios web usa WordPress y cuál es su cuota en el mercado de CMS?**
El 43,5 % de todos los sitios web, que supone el 65,1 % de cuota del mercado de CMS; en español lo emplea el 35 %.

**6. Expón tres ventajas del CMS y tres del desarrollo a medida.**
CMS: rápida implementación, coste inicial bajo y actualizaciones automáticas. A medida: máxima personalización, control total del código y optimización específica, con mantenimiento complejo y mayor plazo como contrapartida.

**7. Detalla los seis pasos de la instalación de WordPress en CDMON.**
Acceder al panel de control; buscar «Instalador de aplicaciones»; seleccionar WordPress; elegir dominio y directorio; configurar los datos de administración; completar la instalación automática.

**8. ¿Qué son los permalinks y qué estructura se recomienda para SEO?**
La estructura de URLs que apuntan a contenido específico de forma permanente. Se recomienda «Nombre de la entrada» (`/sample-post/`): incluye palabras clave, es corta y legible, y las palabras clave en la URL son factor de ranking.

### Conceptos clave

1. **CMS**: aplicación web para crear, gestionar y modificar contenido digital sin programar.
2. **Backend**: panel de administración; único entorno con el que interactúa el usuario.
3. **Frontend**: parte visible del sitio, generada por el CMS.
4. **Separación contenido-diseño**: cambiar el diseño no altera el contenido.
5. **Workflow de publicación**: borrador → revisión → publicación.
6. **Plugin**: extensión que añade funcionalidades.
7. **Tema o plantilla**: define la apariencia visual.
8. **CDMON**: hosting español con panel propio, SSL gratuito, MySQL ilimitado e instalador de WordPress.
9. **Permalink**: estructura permanente de URL que apunta a un contenido concreto.
10. **Snippet**: fragmento que Google muestra bajo el enlace, influido por la descripción breve.
