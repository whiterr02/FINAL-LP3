declare module 'html2pdf.js' {
	export interface Html2PdfOptions {
		margin?: number;
		filename?: string;
		image?: {
			type?: string;
			quality?: number;
		};
		html2canvas?: {
			scale?: number;
		};
		jsPDF?: {
			unit?: string;
			format?: string;
			orientation?: string;
		};
	}

	interface Html2PdfInstance {
		from(element: HTMLElement): Html2PdfInstance;
		set(options: Html2PdfOptions): Html2PdfInstance;
		save(): Promise<void>;
	}

	export default function html2pdf(): Html2PdfInstance;
}
