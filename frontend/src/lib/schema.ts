import { message } from 'sveltekit-superforms';
import { z } from 'zod';

export const schemaProducto = z.object({
	marca: z
		.string()
		.min(1, { message: 'La marca debe tener al menos 1 caracteres' })
		.max(45, { message: 'La marca no puede tener más de 45 caracteres' }),

	modelo: z
		.string()
		.min(1, { message: 'El modelo debe tener al menos 1 carácter' })
		.max(45, { message: 'El modelo no puede tener más de 45 caracteres' }),

	año: z
		.string()
		.min(4, { message: 'El año debe tener al menos 4 caracteres' })
		.max(45, { message: 'El año no puede tener más de 45 caracteres' }),

	color: z
		.string()
		.min(1, { message: 'El color debe tener al menos 1 carácter' })
		.max(45, { message: 'El color no puede tener más de 45 caracteres' }),

	chasis: z
		.string()
		.min(4, { message: 'El chasis debe tener al menos 4 caracteres' })
		.max(100, { message: 'El chasis no puede tener más de 100 caracteres' })
});

export type SchemaProducto = typeof schemaProducto;
