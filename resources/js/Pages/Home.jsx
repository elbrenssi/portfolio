import { useEffect, useMemo } from 'react';
import { Canvas } from '@react-three/fiber';
import { Environment, Float, Html } from '@react-three/drei';
import { motion, useReducedMotion } from 'framer-motion';

export default function Home({ site, sections, projects, experiences, skills, scene, activeProject }) {
  const reduced = useReducedMotion();
  const enabled = site.effects_enabled && !reduced;

  useEffect(() => {
    document.documentElement.style.scrollBehavior = 'smooth';
  }, []);

  const sectionMap = useMemo(() => Object.fromEntries(sections.map((s) => [s.key, s])), [sections]);

  return (
    <div className="min-h-screen bg-[#05070f] text-slate-100">
      <header className="fixed top-0 z-30 w-full backdrop-blur-lg">
        <nav className="mx-auto flex max-w-6xl gap-6 p-4 text-sm">
          {sections.map((section) => <a key={section.key} href={`#${section.key}`}>{section.title}</a>)}
        </nav>
      </header>

      <section id="hero" className="relative h-screen">
        <div className="absolute inset-0">
          {enabled ? (
            <Canvas dpr={[1, 1.5]}>
              <ambientLight intensity={scene?.ambient_light_intensity ?? 0.5} />
              <Float speed={scene?.hero_float_speed ?? 0.5} rotationIntensity={scene?.hero_rotation_speed ?? 0.2}>
                <mesh>
                  <icosahedronGeometry args={[1.4, 1]} />
                  <meshStandardMaterial color="#70e1ff" emissive="#6f3fff" emissiveIntensity={0.4} />
                </mesh>
              </Float>
              <Environment preset="city" />
              <Html center><div className="text-xs text-cyan-300">GLTF: {scene?.hero_model_path ?? 'not set'}</div></Html>
            </Canvas>
          ) : <div className="h-full animate-pulse bg-gradient-to-br from-cyan-900/20 via-purple-900/20 to-black" />}
        </div>

        <div className="relative z-10 mx-auto flex h-full max-w-6xl items-center px-6">
          <div className="max-w-2xl space-y-4">
            <p className="text-cyan-300">{site.tagline}</p>
            <h1 className="text-5xl font-semibold">{site.hero_headline}</h1>
            <p className="text-slate-300">{site.hero_subheadline}</p>
          </div>
        </div>
      </section>

      {['about', 'skills', 'projects', 'experience', 'contact'].map((key) => (
        <section key={key} id={key} className="mx-auto max-w-6xl px-6 py-20">
          <motion.h2 initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} className="mb-4 text-3xl">
            {sectionMap[key]?.title}
          </motion.h2>
          <div dangerouslySetInnerHTML={{ __html: sectionMap[key]?.content_html ?? '' }} />
          {key === 'skills' && <ul>{skills.map((skill) => <li key={skill.id}>{skill.name} - {skill.level}%</li>)}</ul>}
          {key === 'projects' && <div className="grid gap-4 md:grid-cols-2">{projects.map((project) => <a key={project.id} href={`/?project=${project.slug}#projects`} className="rounded-xl border border-white/10 p-4 hover:shadow-[0_0_24px_rgba(112,225,255,.25)]">{project.title}</a>)}</div>}
          {key === 'experience' && <ul>{experiences.map((x) => <li key={x.id}>{x.company} — {x.role}</li>)}</ul>}
        </section>
      ))}

      {activeProject && (
        <div className="fixed inset-0 z-40 bg-black/70 p-6 backdrop-blur-lg">
          <div className="mx-auto max-w-4xl rounded-2xl border border-cyan-500/30 bg-slate-950/90 p-6">
            <a href="/#projects" className="mb-4 inline-block">Close</a>
            <h3 className="text-2xl">{activeProject.title}</h3>
            <div dangerouslySetInnerHTML={{ __html: activeProject.long_description_html }} />
          </div>
        </div>
      )}
    </div>
  );
}
