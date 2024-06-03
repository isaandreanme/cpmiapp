import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
  content: [
    '<path-to-vendor>/awcodes/filament-versions/resources/**/*.blade.php',
    '<path-to-vendor>/awcodes/filament-quick-create/resources/**/*.blade.php',
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/filament/**/*.blade.php',

  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

