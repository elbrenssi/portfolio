import React, { lazy, Suspense, useMemo } from 'react';
import { Head, router } from '@inertiajs/react';

const HeroScene = lazy(() => import('../Components/HeroScene'));

export default function Portfolio({ settings, sections, projects, experiences, skills, scene, activeProjectSlug, seo }) {
  const activeProject = useMemo(() => projects.find((p) => p.slug === activeProjectSlug), [projects, activeProjectSlug]);
  const reduced = typeof window !== 'undefined' && window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const openProject = (slug) => router.get('/', { project: slug }, { preserveScroll: true, preserveState: true, replace: true });
  const closeProject = () => router.get('/', {}, { preserveScroll: true, preserveState: true, replace: true });

  return (
    <>
      <Head>
        <title>{seo.title}</title>
        <meta name="description" content={seo.description} />
      </Head>

      <main className="min-h-screen text-slate-100">
        <section id="hero" className="mx-auto max-w-6xl px-6 py-16">
          <div className="grid items-center gap-8 md:grid-cols-2">
            <div>
              <p className="mb-2 text-cyan-300">{settings.tagline}</p>
              <h1 className="text-4xl font-semibold leading-tight">{settings.hero_headline}</h1>
              <p className="mt-4 text-slate-300">{settings.hero_subheadline}</p>
            </div>
            <div className="glass rounded-2xl p-2">
              {!reduced && settings.effects_enabled ? <Suspense fallback={<div className="h-[320px]" />}><HeroScene intensity={settings.effects_intensity} /></Suspense> : <div className="h-[320px]" />}
            </div>
          </div>
        </section>

        {sections.filter((s) => s.key !== 'hero').map((section) => (
          <section id={section.key} key={section.key} className="mx-auto max-w-6xl px-6 py-12">
            <h2 className="text-2xl font-semibold text-cyan-200">{section.title}</h2>
            <p className="mt-2 text-slate-300">{section.subtitle}</p>
            <div className="prose prose-invert mt-4" dangerouslySetInnerHTML={{ __html: section.content_html || '' }} />

            {section.key === 'projects' && (
              <div className="mt-6 grid gap-4 md:grid-cols-2">
                {projects.map((project) => (
                  <button key={project.id} onClick={() => openProject(project.slug)} className="glass rounded-xl p-4 text-left transition hover:-translate-y-1">
                    <h3 className="text-lg font-medium text-purple-200">{project.title}</h3>
                    <p className="mt-2 text-sm text-slate-300">{project.short_description}</p>
                  </button>
                ))}
              </div>
            )}

            {section.key === 'skills' && (
              <ul className="mt-6 space-y-3">
                {skills.map((skill) => (
                  <li key={skill.id}>
                    <div className="mb-1 flex justify-between text-sm"><span>{skill.name}</span><span>{skill.level}%</span></div>
                    <div className="h-2 rounded bg-slate-800"><div className="h-2 rounded bg-cyan-400" style={{ width: `${skill.level}%` }} /></div>
                  </li>
                ))}
              </ul>
            )}

            {section.key === 'experience' && experiences.map((exp) => (
              <article key={exp.id} className="glass mt-4 rounded-xl p-4">
                <h3 className="font-medium">{exp.role} · {exp.company}</h3>
                <div className="text-sm text-slate-400">{exp.location}</div>
              </article>
            ))}
          </section>
        ))}
      </main>

      {activeProject && (
        <div className="fixed inset-0 z-50 bg-black/70 p-6 backdrop-blur" onClick={closeProject}>
          <div className="glass mx-auto max-w-3xl rounded-2xl p-6" onClick={(e) => e.stopPropagation()}>
            <button className="mb-4 text-sm text-slate-300" onClick={closeProject}>Close</button>
            <h3 className="text-2xl font-semibold">{activeProject.title}</h3>
            <div className="mt-3 text-slate-300" dangerouslySetInnerHTML={{ __html: activeProject.long_description_html || '' }} />
          </div>
        </div>
      )}
    </>
  );
}
