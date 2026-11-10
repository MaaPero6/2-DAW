# Optativa - Gestores de contenido - Tema 2: El panel de administración

## 📌 Resumen Ejecutivo y Objetivos

El panel de administración es la interfaz desde la que se gobierna un sitio WordPress: en él se crea el contenido, se decide cómo se muestra al visitante y se controla quién puede hacer qué. La unidad 2 lo aborda desde tres frentes: la navegación y configuración del escritorio, la gestión de usuarios con sus roles y permisos, y el diseño de flujos de trabajo colaborativos.

Los objetivos de la unidad son:

- **Navegación y configuración:** identificar y utilizar todas las secciones del escritorio, configurar los ajustes generales, de escritura y de lectura, y personalizar el espacio de trabajo.
- **Gestión de usuarios:** crear y administrar usuarios con distintos roles, comprender el sistema de permisos e implementar políticas de seguridad mediante la asignación de cuentas.
- **Flujos de trabajo:** establecer procesos de publicación colaborativa y configurar el sitio para diferentes tipos de contenido.

El resultado esperado es navegar con eficiencia, ajustar los parámetros que determinan el comportamiento del sitio, asignar roles coherentes con cada responsabilidad y aplicar buenas prácticas de seguridad.

## 📖 Desarrollo Teórico Detallado

### 2.1 Acceso al panel y estructura general del menú

El acceso se realiza mediante la URL `tudominio.com/wp-admin`, que presenta una pantalla de inicio de sesión con usuario y contraseña e incluye recordatorio de contraseña. Una vez autenticado, el panel se organiza en un menú lateral con estas secciones y submenús:

| Sección | Submenús |
|---|---|
| ESCRITORIO | Inicio, Actualizaciones |
| ENTRADAS | Todas las entradas, Añadir nueva, Categorías, Etiquetas |
| MEDIOS | Biblioteca, Añadir nuevo |
| PÁGINAS | Todas las páginas, Añadir nueva |
| COMENTARIOS | — |
| APARIENCIA | Temas, Personalizar, Widgets, Menús |
| PLUGINS | — |
| USUARIOS | — |
| AJUSTES | Generales, Escritura, Lectura, Comentarios, Medios, Enlaces permanentes |

El menú revela su lógica: el primer nivel agrupa funciones homogéneas —contenido, presentación, extensión, administración— y los submenús separan la operación cotidiana de la configuración estructural.

### 2.2 El Escritorio como centro de control

El Escritorio es la pantalla de bienvenida y el punto de partida de la sesión; contiene cuatro widgets por defecto:

1. **Bienvenida.** Accesos rápidos, enlaces para personalizar el sitio y estado de la actividad reciente.
2. **Actividad reciente.** Últimas entradas publicadas y comentarios pendientes de moderación, con enlaces rápidos de moderación.
3. **Borrador rápido.** Creación de borradores sin salir del escritorio, idónea para capturar ideas de inmediato.
4. **Noticias y eventos de WordPress.** Novedades de la comunidad y eventos o meetups cercanos.

Su utilidad es la concentración: en una vista se conoce el estado editorial y se accede a las acciones frecuentes.

### 2.3 Personalización del escritorio

La personalización se articula en tres niveles. Las **opciones de pantalla**, arriba a la derecha, permiten mostrar u ocultar widgets, organizarlos por arrastre y fijar el número de columnas. Los **ajustes de usuario**, en «Tu perfil → Opciones de pantalla», definen el diseño en una o dos columnas, el color del esquema —Azul, Claro, Oscuro— y la barra de herramientas. Los **accesos directos** agilizan la creación de contenido:

- `Shift + Alt + C`: añadir un nuevo comentario.
- `Shift + Alt + M`: añadir un nuevo medio.
- `Shift + Alt + P`: añadir una nueva página.

### 2.4 Entradas: el contenido dinámico

Las entradas son el contenido cronológico del sitio: publicaciones ordenadas por fecha y agrupadas mediante categorías y etiquetas. «Todas las entradas» es el listado maestro para consultar, filtrar, editar y eliminar; «Añadir nueva» abre el editor. Las **categorías** establecen una clasificación jerárquica y temática; las **etiquetas**, descriptores más libres y transversales. Ambos condicionan la navegación y la localización de contenidos relacionados.

### 2.5 Medios: la biblioteca de archivos

MEDIOS cumple una doble función: «Biblioteca» concentra los archivos subidos —imágenes, documentos y demás recursos— y permite reutilizarlos en entradas y páginas, mientras «Añadir nuevo» los incorpora. El enfoque centralizado evita duplicidades y permite reutilizar un recurso en varios puntos.

### 2.6 Páginas: el contenido estático

Las páginas se diferencian de las entradas por su carácter atemporal: no se ordenan cronológicamente ni se clasifican con categorías o etiquetas. «Todas las páginas» lista las existentes y «Añadir nueva» crea otras. Suelen corresponder a secciones estables —presentación, contacto, aviso legal— y se integran en los menús definidos desde Apariencia.

### 2.7 Comentarios: la moderación

COMENTARIOS, sin submenús, centraliza la revisión de las aportaciones de los lectores; desde ella se aprueban, se responden, se marcan como spam o se eliminan. Su vínculo con el widget de actividad reciente permite detectar lo pendiente de moderación, delegable en editores y administradores.

### 2.8 Apariencia: la capa de presentación

APARIENCIA reúne el control visual mediante cuatro submenús. **Temas** instala y activa la plantilla que define el diseño global. **Personalizar** abre el ajuste visual del tema activo. **Widgets** gestiona los bloques de las áreas del tema, como barras laterales y pies. **Menús** construye y ordena la navegación, fijando qué enlaces ve el visitante y en qué secuencia.

### 2.9 Plugins: la extensión funcional

PLUGINS, sin submenús, administra los complementos que amplían las capacidades del gestor: se activan, desactivan, actualizan y eliminan desde aquí. Como pueden alterar permisos y comportamientos, la unidad advierte de su incidencia en la gestión de usuarios y en los conflictos.

### 2.10 Usuarios y roles: la jerarquía de permisos

Un usuario es una persona registrada con capacidad de acceso, con distintos niveles de permisos e identificada por un nombre de usuario y un correo únicos. Su perfil agrupa información personal, de cuenta, preferencias de visualización y contacto.

WordPress incorpora seis roles, de mayor a menor capacidad:

| Rol | Alcance | Usuarios y configuración | Contenido |
|---|---|---|---|
| Super Administrador | Solo en Multisite; control total de la red de sitios | Sí, a nivel de red | Todo |
| Administrador | Acceso completo a todas las funciones administrativas | Sí: usuarios, plugins, temas y configuraciones | Todo |
| Editor | Gestión de todo el contenido del sitio | No | Entradas, páginas y comentarios de cualquier autor |
| Autor | Publicación y gestión de sus propias entradas | No | Sus entradas y archivos multimedia |
| Colaborador | Redacción y gestión de sus entradas, sin publicar | No | Sus entradas, con aprobación de Editor o Administrador |
| Suscriptor | Solo su perfil y comentar, si está permitido | No | Ninguno |

La jerarquía es acumulativa: cada rol hereda las capacidades del inferior y añade otras. La frontera decisiva está entre Editor y Administrador: solo este accede a la configuración y a las cuentas.

**Gestión de usuarios.** «Usuarios → Todos los usuarios» ofrece la lista completa, con filtros por rol, búsqueda, edición rápida y eliminación. El proceso de creación es:

1. Usuarios → Añadir nuevo.
2. Información obligatoria: nombre de usuario (único, no modificable), email (único, para notificaciones), contraseña (generar segura) y rol.
3. Opciones adicionales: enviar notificación al usuario, establecer sitio web y biografía, configurar nombre para mostrar.

**Perfil.** En «Usuarios → Tu perfil» cada persona ajusta su información personal (nombre, apellidos, nombre público, contacto, web y biografía, que aparece en la autoría), sus preferencias de cuenta (contraseña, visualización del escritorio) y de contenido (editor visual o HTML, resaltado de código, esquema de color).

### 2.11 Ajustes: la configuración del comportamiento del sitio

**Generales.** Campos críticos: el título del sitio, que aparece en las pestañas y en el SEO, y la descripción breve, meta description por defecto. Se configuran las URLs —dirección de WordPress (instalación) y del sitio (URL pública), que pueden diferir—, la configuración regional (zona horaria, crítica para programar contenidos, y formato de fecha y hora) y las opciones de membresía (registro libre y rol por defecto, normalmente Suscriptor o Colaborador).

**Escritura.** Define la página principal —entradas recientes para el blog clásico o página estática frontal para el sitio corporativo—, las opciones de correo (publicar mediante correo, de raro uso actual, con servidor y puerto para posting remoto) y los servicios de actualización, que notifican por pingback al publicar, con `http://rpc.pingomatic.com/` por defecto.

**Lectura.** Controla el frontend: la página frontal puede ser la de últimas entradas o una página estática, con página frontal y de entradas. El feed RSS se ajusta en número de entradas y en visualización (texto completo o resumen). La visibilidad en buscadores incluye desalentar la indexación, que debe desmarcarse en producción.

Completan la sección Comentarios, Medios y Enlaces permanentes: moderación, archivos y URLs.

## 💡 Ejemplos Prácticos y Aplicaciones

**Caso 1: blog personal.** Un Administrador —dueño del blog—, varios Colaboradores invitados esporádicos y Suscriptores que comentan. El propietario concentra configuración y publicación; los colaboradores redactan y esperan aprobación.

**Caso 2: sitio corporativo pequeño.** Un Administrador responsable de TI, un Editor responsable de comunicación y varios Autores por departamento. El Editor unifica el criterio editorial; los autores publican en su área sin tocar la configuración.

**Caso 3: medio de comunicación online.** Uno o dos Administradores, varios Editores por secciones, múltiples Autores redactores y Colaboradores freelance: los editores filtran, los autores producen y los freelance aportan piezas sujetas a aprobación.

**Alta de un redactor.** En Usuarios → Añadir nuevo se introduce un nombre de usuario único con formato nombre.apellido, un correo único, una contraseña segura y el rol Autor; se marca el envío de notificación y se completa el nombre para mostrar y la biografía. Al recibir el aviso, la persona entra en `tudominio.com/wp-admin` y completa su perfil.

**Problemas frecuentes.** Si un usuario no accede, se verifica el correo de activación, que la cuenta esté activa y que no haya bloqueo de seguridad. Si los permisos fallan, se comprueba el rol, los plugins de gestión de usuarios y los conflictos con temas. Si ve opciones indebidas, se limpia la caché y se confirma que no acumula roles.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

**Conceptos clave**

1. **Panel de administración:** interfaz de gestión, accesible en `tudominio.com/wp-admin`.
2. **Escritorio:** pantalla de bienvenida con widgets de bienvenida, actividad reciente, borrador rápido y noticias.
3. **Entrada:** contenido cronológico, clasificable por categorías y etiquetas.
4. **Página:** contenido estático y atemporal, sin categorías ni etiquetas.
5. **Biblioteca de medios:** repositorio centralizado de archivos reutilizables.
6. **Apariencia:** sección que gobierna temas, personalización, widgets y menús.
7. **Plugin:** extensión que añade funcionalidad y puede alterar permisos.
8. **Rol:** conjunto predefinido de capacidades asignado a un usuario.
9. **Menor privilegio:** asignar solo los permisos necesarios.
10. **Dirección de WordPress frente a dirección del sitio:** ruta de instalación frente a URL pública.

**Preguntas de autoevaluación**

1. **¿Qué diferencia hay entre la dirección de WordPress y la del sitio?** La primera es la ruta de instalación; la segunda, la URL pública. Pueden diferir si WordPress se instala en un subdirectorio.

2. **¿Dónde se decide si la portada muestra el blog o una página estática?** En Ajustes → Lectura, eligiendo entre últimas entradas y página estática, con su página frontal y su página de entradas.

3. **¿Qué puede hacer un Editor que no puede un Autor?** El Editor gestiona todo el contenido —entradas, páginas y comentarios de cualquier autor—; el Autor solo las suyas, sin acceso a configuración ni a usuarios.

4. **¿Por qué el Colaborador no puede publicar?** Puede escribir y gestionar sus entradas, pero publicar requiere aprobación de un Editor o Administrador. Es idóneo para colaboraciones esporádicas.

5. **¿Qué precaución exige la visibilidad en buscadores?** La casilla que desalienta la indexación debe desmarcarse en producción; si no, el sitio queda excluido.

6. **¿Qué tres buenas prácticas se recomiendan para contraseñas?** Mínimo doce caracteres, combinación de mayúsculas, minúsculas, números y símbolos, y cambio cada tres a seis meses.

7. **¿Por qué no debe usarse «admin» como usuario?** Es el identificador más previsible y facilita los accesos no autorizados. Se recomienda nombre.apellido sin datos personales obvios.

8. **¿Qué se comprueba si un usuario ve opciones indebidas?** Se limpia la caché, se verifica que no acumule roles y se revisan los plugins de seguridad.
