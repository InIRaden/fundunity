import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// PWA: Service Worker + Install Prompt + Offline Detector
import { initPWA } from './pwa';
initPWA();



// Conditional page module loading by data-page attribute
try {
	const page = document.body?.dataset?.page;
	if (page === 'landing-home') {
		import('./pages/landing/home').then(mod => {
			if (mod && typeof mod.default === 'function') mod.default();
		}).catch(() => {});
	}
	if (page === 'admin-partners') {
		import('./pages/admin/partners').then(mod => {
			if (mod && typeof mod.default === 'function') mod.default();
		}).catch(() => {});
	}
} catch (e) {
	// ignore
}
