// documento.ts
import type { Documento } from './models';
import type { KyInstance } from 'ky';

export class DocumentoService {
	constructor(private api: KyInstance) {}

	async create(data: { clienteId: number; productoId: number }): Promise<Documento> {
		return await this.api.post('documento', { json: data }).json();
	}

	async search(query: string) {
		return await this.api
			.get('documento/search', {
				searchParams: { q: query }
			})
			.json();
	}
}
