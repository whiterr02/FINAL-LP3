// schema.ts
import { z } from 'zod';

export const schemaDocumento = z.object({
	fecha: z.date(),
	clienteId: z.number().optional(),
	productoId: z.number().optional()
});

export type SchemaDocumento = typeof schemaDocumento;
