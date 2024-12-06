import type { KyInstance } from 'ky';
import type { Cliente } from './models';
type Fetch = typeof fetch;

export class ClienteService {
	constructor(private readonly api: KyInstance) {}

	async getById(id: number, fetch: Fetch): Promise<Cliente> {
		const data = await this.api.get<Cliente>('cliente', { searchParams: { id: id }, fetch }).json();

		return data;
	}

	async all(fetch: Fetch) {
		const data = await this.api.get<Cliente[]>('clientes', { fetch }).json();

		return data;
	}
	async update(cliente: Cliente, fetch?: Fetch) {
		await this.api.patch('cliente', { fetch, json: cliente });
	}

	async create(cliente: Cliente, fetch?: Fetch) {
		await this.api.post('clientes', {
			fetch,
			json: cliente
		});
	}
}
