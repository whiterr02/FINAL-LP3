export type Cliente = {
	id?: number;
	razonSocial: string;
	ci: string;
};

export type ClienteErr = {
	mensaje: string;
};

export type Producto = {
	id?: number;
	marca: string;
	modelo: string;
	año: string;
	color: string;
	chasis: string;
};

export type ProductoErr = {
	mensaje: string;
};

export type Payload<T> = {
	success: boolean;
	data?: T;
	error: string;
};

export type Usuario = {
	ids: number;
	user: string;
	password: string;
};
// Type para el documento (nota de remisión)
export type Documento = {
	id?: number;
	fecha: Date;
	clienteId: number;
	productoId: number;
	cliente?: Cliente; // Relación opcional con Cliente
	producto?: Producto; // Relación opcional con Producto
};

// Type para errores del documento
export type DocumentoErr = {
	mensaje: string;
};
