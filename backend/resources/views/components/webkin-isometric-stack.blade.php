{{-- Isometric stack: API / Auth / Frontend — Webkin palette --}}
<svg
    {{ $attributes->merge(['class' => 'w-full max-w-none']) }}
    viewBox="0 0 440 392"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    role="img"
    aria-label="Webkin stack: API, Auth, Frontend"
>
    <defs>
        <linearGradient id="wk-api-top" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#3f3f46"/>
            <stop offset="100%" stop-color="#27272a"/>
        </linearGradient>
        <linearGradient id="wk-api-left" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#18181b"/>
            <stop offset="100%" stop-color="#09090b"/>
        </linearGradient>
        <linearGradient id="wk-api-right" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#27272a"/>
            <stop offset="100%" stop-color="#18181b"/>
        </linearGradient>
        <linearGradient id="wk-auth-top" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#818cf8"/>
            <stop offset="100%" stop-color="#6366f1"/>
        </linearGradient>
        <linearGradient id="wk-auth-left" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#6366f1"/>
            <stop offset="100%" stop-color="#4f46e5"/>
        </linearGradient>
        <linearGradient id="wk-auth-right" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#4f46e5"/>
            <stop offset="100%" stop-color="#4338ca"/>
        </linearGradient>
        <linearGradient id="wk-vue-top" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#34d399"/>
            <stop offset="100%" stop-color="#10b981"/>
        </linearGradient>
        <linearGradient id="wk-vue-left" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#10b981"/>
            <stop offset="100%" stop-color="#059669"/>
        </linearGradient>
        <linearGradient id="wk-vue-right" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#059669"/>
            <stop offset="100%" stop-color="#047857"/>
        </linearGradient>
        <filter id="wk-shadow" x="-20%" y="-20%" width="140%" height="140%">
            <feDropShadow dx="0" dy="8" stdDeviation="10" flood-color="#18181b" flood-opacity="0.12"/>
        </filter>
    </defs>

    {{-- Ground plane --}}
    <path d="M40 318 L220 408 L400 318 L220 228 Z" fill="#f4f4f5" class="dark:fill-[#1a1a18]"/>
    <path d="M40 318 L220 408 L400 318" stroke="#e4e4e7" stroke-width="1" class="dark:stroke-[#3f3f3a]"/>

    {{-- Connector lines --}}
    <g stroke-width="2" fill="none" stroke-linecap="round">
        <path d="M72 300 C110 250, 130 210, 158 188" stroke="#6366f1" opacity="0.85"/>
        <path d="M58 312 C95 265, 118 228, 148 202" stroke="#10b981" opacity="0.75"/>
        <path d="M86 288 C120 245, 142 215, 168 194" stroke="#18181b" opacity="0.35" class="dark:opacity-60 dark:stroke-[#fafafa]"/>
    </g>

    {{-- Connector nodes --}}
    <g>
        <circle cx="72" cy="300" r="14" fill="#fff" stroke="#6366f1" stroke-width="2" class="dark:fill-[#161615]"/>
        <path d="M68 300h8M72 296v8" stroke="#6366f1" stroke-width="1.5" stroke-linecap="round"/>

        <circle cx="58" cy="312" r="14" fill="#fff" stroke="#10b981" stroke-width="2" class="dark:fill-[#161615]"/>
        <path d="M54.5 312.5 L59.5 307.5 L63.5 311.5 L69 306" stroke="#10b981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>

        <circle cx="86" cy="288" r="14" fill="#fff" stroke="#a1a1aa" stroke-width="2" class="dark:fill-[#161615] dark:stroke-[#71717a]"/>
        <circle cx="86" cy="288" r="4" fill="#18181b" class="dark:fill-[#fafafa]"/>
    </g>

    {{-- Base platform --}}
    <g filter="url(#wk-shadow)">
        <path d="M118 268 L220 326 L322 268 L220 210 Z" fill="#e4e4e7" class="dark:fill-[#3f3f3a]"/>
        <path d="M118 268 L118 278 L220 336 L220 326 Z" fill="#d4d4d8" class="dark:fill-[#27272a]"/>
        <path d="M322 268 L322 278 L220 336 L220 326 Z" fill="#a1a1aa" class="dark:fill-[#18181b]"/>
    </g>

    {{-- API block (main) --}}
    <g filter="url(#wk-shadow)">
        <path d="M132 214 L220 264 L308 214 L220 164 Z" fill="url(#wk-api-top)"/>
        <path d="M132 214 L132 254 L220 304 L220 264 Z" fill="url(#wk-api-left)"/>
        <path d="M308 214 L308 254 L220 304 L220 264 Z" fill="url(#wk-api-right)"/>
        <text x="220" y="248" text-anchor="middle" fill="#fafafa" font-family="Instrument Sans, ui-sans-serif, system-ui, sans-serif" font-size="22" font-weight="600" letter-spacing="0.04em">API</text>
        <text x="220" y="268" text-anchor="middle" fill="#a1a1aa" font-family="Instrument Sans, ui-sans-serif, system-ui, sans-serif" font-size="11" font-weight="500">Laravel</text>
    </g>

    {{-- Auth block --}}
    <g filter="url(#wk-shadow)">
        <path d="M152 168 L220 208 L288 168 L220 128 Z" fill="url(#wk-auth-top)"/>
        <path d="M152 168 L152 196 L220 236 L220 208 Z" fill="url(#wk-auth-left)"/>
        <path d="M288 168 L288 196 L220 236 L220 208 Z" fill="url(#wk-auth-right)"/>
        <text x="220" y="198" text-anchor="middle" fill="#eef2ff" font-family="Instrument Sans, ui-sans-serif, system-ui, sans-serif" font-size="15" font-weight="600">Auth</text>
    </g>

    {{-- Frontend block --}}
    <g filter="url(#wk-shadow)">
        <path d="M168 128 L220 158 L272 128 L220 98 Z" fill="url(#wk-vue-top)"/>
        <path d="M168 128 L168 148 L220 178 L220 158 Z" fill="url(#wk-vue-left)"/>
        <path d="M272 128 L272 148 L220 178 L220 158 Z" fill="url(#wk-vue-right)"/>
        <text x="220" y="152" text-anchor="middle" fill="#ecfdf5" font-family="Instrument Sans, ui-sans-serif, system-ui, sans-serif" font-size="13" font-weight="600">Vue</text>
    </g>

    {{-- Floating badges (right) --}}
    <g>
        <circle cx="332" cy="292" r="16" fill="#fff" stroke="#e4e4e7" stroke-width="1.5" class="dark:fill-[#161615] dark:stroke-[#3f3f3a]"/>
        <path d="M326 292h12M332 286v12" stroke="#6366f1" stroke-width="1.5" stroke-linecap="round"/>

        <circle cx="356" cy="318" r="16" fill="#fff" stroke="#e4e4e7" stroke-width="1.5" class="dark:fill-[#161615] dark:stroke-[#3f3f3a]"/>
        <path d="M350 318h12" stroke="#10b981" stroke-width="1.5" stroke-linecap="round"/>
        <path d="M356 312v12" stroke="#10b981" stroke-width="1.5" stroke-linecap="round"/>

        <circle cx="380" cy="344" r="16" fill="#fff" stroke="#e4e4e7" stroke-width="1.5" class="dark:fill-[#161615] dark:stroke-[#3f3f3a]"/>
        <circle cx="380" cy="344" r="5" fill="#18181b" class="dark:fill-[#fafafa]"/>
    </g>

    {{-- Brand mark --}}
    <text x="220" y="56" text-anchor="middle" fill="#18181b" font-family="Instrument Sans, ui-sans-serif, system-ui, sans-serif" font-size="34" font-weight="600" letter-spacing="-0.02em" class="dark:fill-[#fafafa]">Webkin</text>
</svg>
