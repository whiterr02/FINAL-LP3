import { message } from 'sveltekit-superforms';
import { z } from 'zod';

export const schemaCliente = z.object({
	ci: z
		.string()
		.min(4, { message: 'Ci debe de tener mas de 4 caracteres' })
		.max(10, { message: 'Ci no puede tener mas de 10 caracteres' }),

	razonSocial: z
		.string()
		.min(1, { message: 'Razon Social debe de tener mas de 1 caracteres' })
		.max(255, { message: 'Razon Social no puede tener mas de 255 caracteres' })
});

export type SchemaCliente = typeof schemaCliente;
