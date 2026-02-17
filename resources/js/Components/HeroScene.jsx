import React, { Suspense } from 'react';
import { Canvas } from '@react-three/fiber';
import { Float } from '@react-three/drei';

export default function HeroScene({ intensity = 60 }) {
  const dpr = typeof window !== 'undefined' ? Math.min(window.devicePixelRatio || 1, 1.75) : 1;
  return (
    <div className="h-[320px] w-full">
      <Canvas dpr={dpr} camera={{ position: [0, 0, 5], fov: 45 }}>
        <ambientLight intensity={0.5 + intensity / 200} />
        <Suspense fallback={null}>
          <Float speed={1.2} rotationIntensity={0.45} floatIntensity={0.75}>
            <mesh>
              <icosahedronGeometry args={[1.2, 1]} />
              <meshStandardMaterial color="#22d3ee" emissive="#7c3aed" emissiveIntensity={0.2} />
            </mesh>
          </Float>
        </Suspense>
      </Canvas>
    </div>
  );
}
