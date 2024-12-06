import { ClienteService } from './cliente';
import { ProductoService } from './producto';
import { DocumentoService } from './documento';
import { api } from './api';

export const services = {
	cliente: new ClienteService(api),
	producto: new ProductoService(api),
	documento: new DocumentoService(api)
};
