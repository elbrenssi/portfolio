import { Head, router } from '@inertiajs/react';
import { Canvas } from '@react-three/fiber';
import { Float, OrbitControls } from '@react-three/drei';
import { lazy, Suspense, useMemo, useState } from 'react';

const isTouch = typeof window !== 'undefined' && window.matchMedia('(pointer: coarse)').matches;

function Hero3D({ scene }) {
  return (
    <div className="h-72 w-full rounded-2xl overflow-hidden bg-gradient-to-br from-indigo-500/20 to-cyan-500/20">
      <Canvas dpr={[1, 1.5]}>
        <ambientLight intensity={scene?.ambient_light_intensity ?? 1} />
        <Float speed={scene?.hero_float_speed ?? 1} rotationIntensity={scene?.hero_rotation_speed ?? 0.2}>
          <mesh><icosahedronGeometry args={[1.4, 1]} /><meshStandardMaterial color="#67e8f9" /></mesh>
        </Float>
        <OrbitControls enableZoom={false} autoRotate autoRotateSpeed={0.5} />
      </Canvas>
    </div>
  );
}

export default function Portfolio({ site_settings, sections, projects, skills, experiences, activeProject, seo, currentLocale }) {
  const [theme, setTheme] = useState(typeof window !== 'undefined' ? (localStorage.getItem('theme') || site_settings?.theme_default || 'dark') : 'dark');
  if (typeof document !== 'undefined') document.documentElement.classList.toggle('dark', theme === 'dark');

  const jsonLd = useMemo(() => ({ '@context': 'https://schema.org', '@type': 'WebSite', name: site_settings?.site_name?.[currentLocale], url: seo.canonical }), [site_settings, currentLocale, seo]);

  const toggleTheme = () => {
    const next = theme === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', next);
    setTheme(next);
  };

  const changeLocale = (locale) => router.post('/locale', { locale });
  const openProject = (slug) => router.get('/', { project: slug }, { preserveState: true, replace: false });
  const closeProject = () => router.get('/', {}, { preserveState: true, replace: true });

  return (
    <>
      <Head>
        <title>{seo.title}</title>
        <meta name="description" content={seo.description || ''} />
        <link rel="canonical" href={seo.canonical} />
        <meta property="og:title" content={seo.title || ''} />
        <meta property="og:description" content={seo.description || ''} />
        <meta property="twitter:card" content="summary_large_image" />
        <script type="application/ld+json">{JSON.stringify(jsonLd)}</script>
      </Head>
      <div className="fixed top-4 right-4 z-50 flex gap-2">
        <button className="px-3 py-1 rounded bg-slate-800 text-white" onClick={toggleTheme}>{theme}</button>
        {['en','fr','ar'].map((l) => <button key={l} className="px-2 py-1 rounded border" onClick={() => changeLocale(l)}>{l.toUpperCase()}</button>)}
      </div>
      <nav className="sticky top-0 bg-black/40 backdrop-blur p-4 z-40"><div className="flex gap-4">{sections.map((s) => <a key={s.key} href={`#${s.key}`}>{s.title[currentLocale]}</a>)}</div></nav>
      <main className="max-w-5xl mx-auto p-6 space-y-16">
        <section id="hero"><h1 className="text-4xl font-bold">{site_settings?.hero_headline?.[currentLocale]}</h1><Hero3D scene={site_settings} /></section>
        {sections.filter((s) => s.key !== 'hero').map((section) => (
          <section id={section.key} key={section.id}>
            <h2 className="text-2xl font-semibold">{section.title[currentLocale]}</h2>
            <div dangerouslySetInnerHTML={{ __html: section.content_html?.[currentLocale] || '' }} />
          </section>
        ))}
        <section id="projects"><h2 className="text-2xl">Projects</h2><div className="grid md:grid-cols-2 gap-4">{projects.map((p) => <button key={p.id} onClick={() => openProject(p.slug)} className="magic-card text-left border rounded-xl p-4"><h3>{p.title[currentLocale]}</h3></button>)}</div></section>
      </main>
      {activeProject && <div className="fixed inset-0 bg-black/80 p-10 z-50" onClick={closeProject}><div className="max-w-3xl bg-slate-900 p-6" onClick={(e) => e.stopPropagation()}><h3>{activeProject.title[currentLocale]}</h3><div dangerouslySetInnerHTML={{ __html: activeProject.long_description_html[currentLocale] }} /></div></div>}
      {!isTouch && <div className="pointer-events-none fixed inset-0" />}
    </>
  );
}
