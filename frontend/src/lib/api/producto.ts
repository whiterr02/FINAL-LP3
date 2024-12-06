import type { KyInstance } from 'ky';
import type { Producto } from './models';
type Fetch = typeof fetch;

export class ProductoService {
	constructor(private readonly api: KyInstance) {}

	async getById(id: number, fetch: Fetch): Promise<Producto> {
		const data = await this.api
			.get<Producto>('producto', { searchParams: { id: id }, fetch })
			.json();

		return data;
	}

	async all(fetch: Fetch) {
		const data = await this.api.get<Producto[]>('productos', { fetch }).json();

		return data;
	}

	async update(producto: Producto, fetch?: Fetch) {
		await this.api.patch('producto', { fetch, json: producto });
	}

	async create(producto: Producto, fetch?: Fetch) {
		await this.api.post('productos', {
			fetch,
			json: producto
		});
	}
}
