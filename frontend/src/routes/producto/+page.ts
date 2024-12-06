import { services } from '$lib/api';
import { type Producto, type ProductoErr, type Payload } from '$lib/api/models';
import { HTTPError } from 'ky';
import { superValidate } from 'sveltekit-superforms';
import { schemaProducto } from '../../lib/schema';
import { zod } from 'sveltekit-superforms/adapters';

export const load = async ({ fetch }) => {
	const crearForm = await superValidate(zod(schemaProducto));
	const editarForm = await superValidate(zod(schemaProducto));
	let payload: Payload<Producto[]> = { success: false, error: '' };

	try {
		const producto = await services.producto.all(fetch);
		payload = { success: true, data: producto, error: '' };
	} catch (err) {
		if (err instanceof HTTPError) {
			const error = await err.response.json<ProductoErr>();

			payload = { success: false, error: error.mensaje };
		}
	}
	return { payload, editarForm, crearForm };
};
