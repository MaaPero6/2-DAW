// Variable global en el ámbito de cliente para retener la carga en memoria RAM
let catalogoProductos = [];

const categoriasDisponibles = ["Informática", "Telefonía", "Hogar", "Audio", "Oficina"];
const salida = document.getElementById("consolaVisual");

// 1. GENERACIÓN DE DATOS (Carga en memoria RAM del dispositivo cliente)
document.getElementById("btnGenerar").addEventListener("click", () => {
    salida.textContent = "Generando 500000 registros en la RAM del cliente...";

    // Iniciamos el cronómetro de la consola
    console.time("Tiempo de generación en RAM");

    catalogoProductos = [];
    const TOTAL_REGISTROS = 500000;

    for (let i = 1; i <= TOTAL_REGISTROS; i++) {
        catalogoProductos.push({
            id: i,
            nombre: `Producto ${i}`,
            precio: parseFloat((Math.random() * 900 + 10).toFixed(2)),
            categoria: categoriasDisponibles[Math.floor(Math.random() * categoriasDisponibles.length)]
        });
    }

    // Detenemos el cronómetro
    console.timeEnd("Tiempo de generación en RAM");

    salida.textContent = `Generados ${TOTAL_REGISTROS.toLocaleString()} productos en memoria RAM local.\nRevisa la consola (F12) para ver el tiempo exacto.`;
});

// 2. ORDENACIÓN EN CLIENTE (Consumo intensivo de CPU local)
document.getElementById("btnOrdenar").addEventListener("click", () => {
    if (catalogoProductos.length === 0) {
        salida.textContent = "Primero genera los productos.";
        return;
    }

    salida.textContent = "Ordenando catálogo por precio mediante la CPU del navegador...";

    // Medición con timer
    console.time("Tiempo de ordenación (CPU Cliente)");

    // Algoritmo de ordenación con predicado
    catalogoProductos.sort((a, b) => a.precio - b.precio);

    console.timeEnd("Tiempo de ordenación (CPU Cliente)");

    salida.textContent = `Ordenación completada.\n- Producto más caro: ${catalogoProductos[catalogoProductos.length - 1].precio}  €\n- Producto más barato: ${catalogoProductos[0].precio} €\n(Consumo de cómputo transferido con éxito del servidor al cliente).`;
});

// 3. FILTRADO DECLARATIVO (Procesamiento y asignación de nueva memoria)
document.getElementById("btnFiltrar").addEventListener("click", () => {
    if (catalogoProductos.length === 0) {
        salida.textContent = "Primero genera los productos.";
        return;
    }

    salida.textContent = "Filtrando productos de la categoría 'Telefonia'...";

    console.time("Tiempo de filtrado (.filter)");

    const productosFiltrados = catalogoProductos.filter(prod => prod.categoria === "Telefonia");

    console.timeEnd("Tiempo de filtrado (.filter)");

    salida.textContent = `Filtrado completado con éxito.\n- Registros encontrados: ${productosFiltrados.length.toLocaleString()}\nEl servidor no ha tenido que ejecutar ninguna consulta SQL ni consumir hilos de procesamiento.`;
});
