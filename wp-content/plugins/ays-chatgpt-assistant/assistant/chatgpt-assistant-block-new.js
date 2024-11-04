(function($){
    
    $(document).ready(function () {
        var WPelement = wp.element;
        var WPdata = wp.data;
        var WPcomponents = wp.components;
        var WPblocks = wp.blocks;
        var WPeditor = wp.editor;
        var WPplugins = wp.plugins;
        var WPeditPost = wp.editPost;
        var WPi18n = wp.i18n;
        
        var el = WPelement.createElement;
        var registerPlugin = WPplugins.registerPlugin;
        var __ = WPi18n.__;
    
        var panel = WPeditPost.PluginDocumentSettingPanel;
        var sidebar = WPeditPost.PluginSidebar;
    
        var select = WPcomponents.SelectControl;
        var number = WPcomponents.__experimentalNumberControl || WPcomponents.TextControl;
        var divider = WPcomponents.__experimentalDivider;
        var text = WPcomponents.TextareaControl;
        var range = WPcomponents.RangeControl;
        var button = WPcomponents.Button;

        var settings = configureSettings();
        
        var iconEl = el(
            'svg', 
            { 
                width: 24,
                height: 24,
                viewBox: '0 0 400 400'
            },
            el(
                'g',
                {},
                el(
                    'path',
                    { 
                        d: "M196.484 41.287 C 144.010 46.910,108.730 67.925,90.650 104.329 C 83.218 119.294,78.524 138.432,78.517 153.802 L 78.516 156.627 76.465 157.667 C 40.281 176.002,44.453 230.801,82.902 242.222 C 86.557 243.308,86.518 243.257,87.082 247.852 C 93.453 299.820,128.587 336.036,185.547 349.351 C 186.486 349.570,186.523 349.697,186.524 352.631 C 186.526 366.773,205.920 371.030,212.203 358.267 C 218.512 345.453,202.933 332.932,191.516 341.641 L 190.215 342.633 186.025 341.596 C 153.926 333.651,126.754 315.641,110.893 291.797 C 100.248 275.793,92.768 250.550,94.465 236.355 C 94.960 232.213,94.937 231.152,94.189 223.633 C 93.739 219.121,93.187 213.320,92.962 210.742 C 92.736 208.164,92.128 202.803,91.611 198.828 C 88.341 173.709,88.340 151.885,91.608 135.690 C 100.275 92.741,133.950 63.227,185.156 53.703 C 189.459 52.902,196.671 51.953,198.451 51.953 L 200.000 51.953 200.000 46.484 L 200.000 41.016 198.926 41.078 C 198.335 41.113,197.236 41.207,196.484 41.287 M232.927 53.724 C 209.226 60.109,213.310 95.311,237.752 95.313 L 240.430 95.313 243.000 104.474 L 245.570 113.636 238.703 116.174 C 234.926 117.571,231.633 118.765,231.385 118.829 C 231.137 118.893,230.406 118.222,229.761 117.338 C 226.481 112.845,219.302 112.399,215.264 116.436 C 210.189 121.512,212.365 130.602,219.129 132.573 L 220.898 133.089 221.004 141.297 L 221.109 149.504 219.594 149.708 C 210.757 150.893,207.942 162.340,215.137 167.828 C 219.053 170.815,225.530 170.115,228.687 166.364 L 229.574 165.309 231.775 166.737 L 233.975 168.164 233.733 171.136 C 232.301 188.699,253.079 198.584,265.655 186.322 C 270.697 181.406,272.467 174.374,270.461 167.233 C 269.748 164.697,268.777 165.605,279.028 159.227 L 287.547 153.926 289.574 155.531 C 301.306 164.825,317.970 152.399,311.661 139.063 C 304.021 122.916,279.201 133.003,285.538 149.680 C 285.962 150.797,286.270 151.743,286.221 151.782 C 286.072 151.901,273.393 159.800,270.895 161.330 L 268.547 162.767 266.920 160.945 L 265.293 159.122 270.735 139.815 C 273.728 129.196,276.900 117.914,277.784 114.743 L 279.390 108.978 280.808 110.257 C 295.520 123.531,317.857 106.626,309.165 88.798 C 299.671 69.326,271.004 80.140,275.391 101.539 C 275.580 102.461,275.223 102.626,264.273 106.698 C 258.052 109.011,252.924 110.867,252.880 110.822 C 252.835 110.778,251.668 106.743,250.287 101.857 L 247.776 92.973 249.409 92.016 C 253.244 89.768,257.148 84.403,258.417 79.636 C 262.451 64.478,247.904 49.690,232.927 53.724 M194.141 62.374 C 149.070 66.974,116.236 91.380,103.583 129.688 C 96.947 149.779,95.840 168.820,99.803 194.727 C 102.940 215.234,104.872 230.936,105.881 244.141 C 108.046 272.452,117.223 287.194,144.642 306.399 C 147.603 308.474,151.910 311.824,154.212 313.844 C 175.043 332.123,182.104 335.302,201.172 334.988 C 218.314 334.706,225.765 331.041,246.094 312.896 C 247.705 311.457,251.484 308.559,254.492 306.454 C 282.490 286.865,292.053 271.044,293.573 241.797 C 293.827 236.907,295.449 222.729,297.279 209.407 C 297.916 204.770,298.437 200.757,298.437 200.488 C 298.437 200.111,296.319 200.000,289.147 200.000 L 279.856 200.000 279.115 201.270 C 274.952 208.404,264.406 214.063,255.273 214.063 C 247.224 214.063,241.104 211.311,233.984 204.490 C 221.779 192.796,207.857 187.689,195.179 190.256 C 184.694 192.379,174.530 197.266,170.585 202.080 C 158.382 216.971,132.516 213.652,123.934 196.094 C 110.153 167.898,143.611 141.917,168.055 161.833 C 176.172 168.446,186.090 172.443,195.605 172.936 L 200.000 173.163 200.000 117.636 L 200.000 62.109 197.754 62.172 C 196.519 62.206,194.893 62.297,194.141 62.374 M277.069 105.599 C 277.335 106.292,263.110 156.843,262.657 156.812 C 262.463 156.799,261.317 156.328,260.109 155.765 C 258.901 155.202,257.275 154.622,256.495 154.476 C 254.803 154.158,254.848 154.756,255.943 147.113 L 256.832 140.906 258.437 140.218 C 268.541 135.887,267.187 121.304,256.410 118.403 C 254.900 117.996,254.785 117.857,254.193 115.731 C 253.438 113.017,251.831 114.015,264.675 109.215 C 276.107 104.944,276.746 104.757,277.069 105.599 M246.882 118.188 L 247.381 119.970 245.779 121.606 C 239.085 128.446,243.634 141.016,252.804 141.016 C 254.145 141.016,254.135 140.789,253.126 148.037 C 252.213 154.604,252.646 153.838,249.566 154.334 C 248.196 154.555,246.330 155.065,245.420 155.467 C 244.510 155.870,243.686 156.079,243.590 155.932 C 243.494 155.785,239.986 150.136,235.795 143.379 L 228.175 131.094 229.501 129.626 C 230.953 128.019,232.160 124.588,231.959 122.638 L 231.836 121.434 238.477 118.943 C 246.545 115.915,246.253 115.942,246.882 118.188 M234.478 144.608 L 242.197 157.146 241.314 157.739 C 239.574 158.905,236.803 162.197,235.722 164.380 C 235.117 165.602,234.584 166.658,234.536 166.727 C 234.489 166.796,233.549 166.269,232.447 165.555 C 230.503 164.296,230.454 164.218,230.750 162.891 C 232.003 157.271,229.796 152.554,224.902 150.392 L 223.047 149.573 223.047 141.425 L 223.047 133.277 224.707 132.704 C 225.620 132.388,226.455 132.116,226.563 132.100 C 226.670 132.083,230.232 137.712,234.478 144.608",
                        stroke: "none",
                        fill: "#fbfbfb",
                        fillRule: "evenodd"
                    }
                ),
                el(
                    'path',
                    { 
                        d: "M104.688 0.622 C 49.865 7.194,6.908 50.375,0.585 105.271 C -0.294 112.897,-0.294 287.103,0.585 294.729 C 6.938 349.882,50.118 393.062,105.271 399.415 C 112.897 400.294,287.103 400.294,294.729 399.415 C 349.882 393.062,393.062 349.882,399.415 294.729 C 400.294 287.103,400.294 112.897,399.415 105.271 C 393.062 50.118,349.882 6.938,294.729 0.585 C 287.463 -0.252,111.694 -0.218,104.688 0.622 M200.000 46.484 L 200.000 51.953 198.451 51.953 C 181.578 51.953,151.143 62.152,133.479 73.724 C 96.092 98.220,83.436 136.036,91.611 198.828 C 92.128 202.803,92.736 208.164,92.962 210.742 C 93.187 213.320,93.739 219.121,94.189 223.633 C 94.937 231.152,94.960 232.213,94.465 236.355 C 92.768 250.550,100.248 275.793,110.893 291.797 C 126.754 315.641,153.926 333.651,186.025 341.596 L 190.215 342.633 191.516 341.641 C 202.933 332.932,218.512 345.453,212.203 358.267 C 205.920 371.030,186.526 366.773,186.524 352.631 C 186.523 349.697,186.486 349.570,185.547 349.351 C 128.587 336.036,93.453 299.820,87.082 247.852 C 86.518 243.257,86.557 243.308,82.902 242.222 C 44.453 230.801,40.281 176.002,76.465 157.667 L 78.516 156.627 78.517 153.802 C 78.522 142.972,81.571 126.846,85.767 115.462 C 99.744 77.538,131.495 52.917,177.946 43.981 C 183.442 42.924,195.226 41.293,198.926 41.078 L 200.000 41.016 200.000 46.484 M242.932 53.726 C 260.605 57.892,264.846 82.969,249.409 92.016 L 247.776 92.973 250.287 101.857 C 251.668 106.743,252.835 110.778,252.880 110.822 C 252.924 110.867,258.052 109.011,264.273 106.698 C 275.223 102.626,275.580 102.461,275.391 101.539 C 271.004 80.140,299.671 69.326,309.165 88.798 C 317.857 106.626,295.520 123.531,280.808 110.257 L 279.390 108.978 277.784 114.743 C 276.900 117.914,273.728 129.196,270.735 139.815 L 265.293 159.122 266.920 160.945 L 268.547 162.767 270.895 161.330 C 273.393 159.800,286.072 151.901,286.221 151.782 C 286.270 151.743,285.962 150.797,285.538 149.680 C 280.156 135.516,299.316 123.921,309.258 135.324 C 320.719 148.470,303.271 166.383,289.574 155.531 L 287.547 153.926 279.028 159.227 C 268.777 165.605,269.748 164.697,270.461 167.233 C 272.467 174.374,270.697 181.406,265.655 186.322 C 253.079 198.584,232.301 188.699,233.733 171.136 L 233.975 168.164 231.775 166.737 L 229.574 165.309 228.687 166.364 C 225.530 170.115,219.053 170.815,215.137 167.828 C 207.942 162.340,210.757 150.893,219.594 149.708 L 221.109 149.504 221.004 141.297 L 220.898 133.089 219.129 132.573 C 212.365 130.602,210.189 121.512,215.264 116.436 C 219.302 112.399,226.481 112.845,229.761 117.338 C 230.406 118.222,231.137 118.893,231.385 118.829 C 231.633 118.765,234.926 117.571,238.703 116.174 L 245.570 113.636 243.000 104.474 L 240.430 95.313 237.752 95.313 C 222.539 95.312,212.184 78.711,218.959 65.183 C 223.553 56.010,233.155 51.422,242.932 53.726 M200.000 117.636 L 200.000 173.163 195.605 172.936 C 186.090 172.443,176.172 168.446,168.055 161.833 C 143.611 141.917,110.153 167.898,123.934 196.094 C 132.516 213.652,158.382 216.971,170.585 202.080 C 174.530 197.266,184.694 192.379,195.179 190.256 C 207.857 187.689,221.779 192.796,233.984 204.490 C 239.908 210.165,243.363 212.133,249.693 213.441 C 260.702 215.715,273.863 210.271,279.115 201.270 L 279.856 200.000 289.147 200.000 C 296.319 200.000,298.437 200.111,298.437 200.488 C 298.437 200.757,297.916 204.770,297.279 209.407 C 295.449 222.729,293.827 236.907,293.573 241.797 C 292.053 271.044,282.490 286.865,254.492 306.454 C 251.484 308.559,247.705 311.457,246.094 312.896 C 225.765 331.041,218.314 334.706,201.172 334.988 C 182.104 335.302,175.043 332.123,154.212 313.844 C 151.910 311.824,147.603 308.474,144.642 306.399 C 117.223 287.194,108.046 272.452,105.881 244.141 C 104.872 230.936,102.940 215.234,99.803 194.727 C 96.846 175.396,96.629 165.318,98.846 150.195 C 104.785 109.680,127.552 81.690,165.236 68.573 C 174.524 65.340,189.443 62.403,197.754 62.172 L 200.000 62.109 200.000 117.636 M264.675 109.215 C 251.831 114.015,253.438 113.017,254.193 115.731 C 254.785 117.857,254.900 117.996,256.410 118.403 C 267.187 121.304,268.541 135.887,258.437 140.218 L 256.832 140.906 255.943 147.113 C 254.848 154.756,254.803 154.158,256.495 154.476 C 257.275 154.622,258.901 155.202,260.109 155.765 C 261.317 156.328,262.463 156.799,262.657 156.812 C 263.110 156.843,277.335 106.292,277.069 105.599 C 276.746 104.757,276.107 104.944,264.675 109.215 M238.477 118.943 L 231.836 121.434 231.959 122.638 C 232.160 124.588,230.953 128.019,229.501 129.626 L 228.175 131.094 235.795 143.379 C 239.986 150.136,243.494 155.785,243.590 155.932 C 243.686 156.079,244.510 155.870,245.420 155.467 C 246.330 155.065,248.196 154.555,249.566 154.334 C 252.646 153.838,252.213 154.604,253.126 148.037 C 254.135 140.789,254.145 141.016,252.804 141.016 C 243.634 141.016,239.085 128.446,245.779 121.606 L 247.381 119.970 246.882 118.188 C 246.253 115.942,246.545 115.915,238.477 118.943 M224.707 132.704 L 223.047 133.277 223.047 141.425 L 223.047 149.573 224.902 150.392 C 229.796 152.554,232.003 157.271,230.750 162.891 C 230.454 164.218,230.503 164.296,232.447 165.555 C 233.549 166.269,234.489 166.796,234.536 166.727 C 234.584 166.658,235.117 165.602,235.722 164.380 C 236.803 162.197,239.574 158.905,241.314 157.739 L 242.197 157.146 234.478 144.608 C 230.232 137.712,226.670 132.083,226.563 132.100 C 226.455 132.116,225.620 132.388,224.707 132.704",
                        stroke: "none",
                        fill: "#3ec094",
                        fillRule: "evenodd"
                    }
                )
            )
        );
        var loaderEl = el(
            'svg',
            {
                width: 20,
                height: 20,
                viewBox: "0 0 38 38",
                stroke: "#fff",
                className: "ays-chatgpt-assistant-title-loader"
            },
            el(
                'g',
                {
                    fill: 'none',
                    fillRule: "evenodd"
                },
                el(
                    'g',
                    {
                        transform: 'translate(1 1)',
                        strokeWidth: 2
                    },
                    el(
                        'circle',
                        {
                            strokeOpacity: ".5",
                            cx: 18,
                            cy: 18,
                            r: 18
                        },
                        ''
                    ),
                    el(
                        'path',
                        {
                            d: "M36 18c0-9.94-8.06-18-18-18"
                        },
                        el(
                            'animateTransform',
                            {
                                attributeName: "transform",
                                type: "rotate",
                                from: "0 18 18",
                                to: "360 18 18",
                                dur: "1s",
                                repeatCount: "indefinite",
                            },
                            ''
                        ),
                    ),
                )
            )
        );

        var modelList = [
            { label: "gpt-3.5-turbo-16k", value: "gpt-3.5-turbo-16k" },
            { label: "gpt-3.5-turbo", value: "gpt-3.5-turbo" },
        ];
        var styleList = [
            { label: __("Informative", "chatgpt-assistant"), value: "informative" },
            { label: __("Academic", "chatgpt-assistant"), value: "academic" },
            { label: __("Analytical", "chatgpt-assistant"), value: "analytical" },
            { label: __("Anecdotal", "chatgpt-assistant"), value: "anecdotal" },
            { label: __("Argumentative", "chatgpt-assistant"), value: "argumentative" },
            { label: __("Articulate", "chatgpt-assistant"), value: "articulate" },
            { label: __("Biographical", "chatgpt-assistant"), value: "biographical" },
            { label: __("Blog", "chatgpt-assistant"), value: "blog" },
            { label: __("Casual", "chatgpt-assistant"), value: "casual" },
            { label: __("Colloquial", "chatgpt-assistant"), value: "colloquial" },
            { label: __("Comparative", "chatgpt-assistant"), value: "comparative" },
            { label: __("Concise", "chatgpt-assistant"), value: "concise" },
            { label: __("Creative", "chatgpt-assistant"), value: "creative" },
            { label: __("Critical", "chatgpt-assistant"), value: "critical" },
            { label: __("Descriptive", "chatgpt-assistant"), value: "descriptive" },
            { label: __("Detailed", "chatgpt-assistant"), value: "detailed" },
            { label: __("Dialogue", "chatgpt-assistant"), value: "dialogue" },
            { label: __("Direct", "chatgpt-assistant"), value: "direct" },
            { label: __("Dramatic", "chatgpt-assistant"), value: "dramatic" },
            { label: __("Emotional", "chatgpt-assistant"), value: "emotional" },
            { label: __("Evaluative", "chatgpt-assistant"), value: "evaluative" },
            { label: __("Expository", "chatgpt-assistant"), value: "expository" },
            { label: __("Fiction", "chatgpt-assistant"), value: "fiction" },
            { label: __("Historical", "chatgpt-assistant"), value: "historical" },
            { label: __("Journalistic", "chatgpt-assistant"), value: "journalistic" },
            { label: __("Letter", "chatgpt-assistant"), value: "letter" },
            { label: __("Metaphorical", "chatgpt-assistant"), value: "metaphorical" },
            { label: __("Monologue", "chatgpt-assistant"), value: "monologue" },
            { label: __("Narrative", "chatgpt-assistant"), value: "narrative" },
            { label: __("News", "chatgpt-assistant"), value: "news" },
            { label: __("Objective", "chatgpt-assistant"), value: "objective" },
            { label: __("Lyrical", "chatgpt-assistant"), value: "lyrical" },
            { label: __("Pastoral", "chatgpt-assistant"), value: "pastoral" },
            { label: __("Personal", "chatgpt-assistant"), value: "personal" },
            { label: __("Persuasive", "chatgpt-assistant"), value: "persuasive" },
            { label: __("Poetic", "chatgpt-assistant"), value: "poetic" },
            { label: __("Reflective", "chatgpt-assistant"), value: "reflective" },
            { label: __("Rhetorical", "chatgpt-assistant"), value: "rhetorical" },
            { label: __("Satirical", "chatgpt-assistant"), value: "satirical" },
            { label: __("Sensory", "chatgpt-assistant"), value: "sensory" },
            { label: __("Simple", "chatgpt-assistant"), value: "simple" },
            { label: __("Technical", "chatgpt-assistant"), value: "technical" },
            { label: __("Theoretical", "chatgpt-assistant"), value: "theoretical" },
            { label: __("Vivid", "chatgpt-assistant"), value: "vivid" },
            { label: __("Business", "chatgpt-assistant"), value: "business" },
            { label: __("Report", "chatgpt-assistant"), value: "report" },
            { label: __("Research", "chatgpt-assistant"), value: "research" }
        ];
        var toneList = [
            { label: __("Formal", "chatgpt-assistant"), value: "formal" },
            { label: __("Assertive", "chatgpt-assistant"), value: "assertive" },
            { label: __("Authoritative", "chatgpt-assistant"), value: "authoritative" },
            { label: __("Cheerful", "chatgpt-assistant"), value: "cheerful" },
            { label: __("Confident", "chatgpt-assistant"), value: "confident" },
            { label: __("Conversational", "chatgpt-assistant"), value: "conversational" },
            { label: __("Factual", "chatgpt-assistant"), value: "factual" },
            { label: __("Friendly", "chatgpt-assistant"), value: "friendly" },
            { label: __("Humorous", "chatgpt-assistant"), value: "humorous" },
            { label: __("Informal", "chatgpt-assistant"), value: "informal" },
            { label: __("Inspirational", "chatgpt-assistant"), value: "inspirational" },
            { label: __("Neutral", "chatgpt-assistant"), value: "neutral" },
            { label: __("Nostalgic", "chatgpt-assistant"), value: "nostalgic" },
            { label: __("Polite", "chatgpt-assistant"), value: "polite" },
            { label: __("Professional", "chatgpt-assistant"), value: "professional" },
            { label: __("Romantic", "chatgpt-assistant"), value: "romantic" },
            { label: __("Sarcastic", "chatgpt-assistant"), value: "sarcastic" },
            { label: __("Scientific", "chatgpt-assistant"), value: "scientific" },
            { label: __("Sensitive", "chatgpt-assistant"), value: "sensitive" },
            { label: __("Serious", "chatgpt-assistant"), value: "serious" },
            { label: __("Sincere", "chatgpt-assistant"), value: "sincere" },
            { label: __("Skeptical", "chatgpt-assistant"), value: "skeptical" },
            { label: __("Suspenseful", "chatgpt-assistant"), value: "suspenseful" },
            { label: __("Sympathetic", "chatgpt-assistant"), value: "sympathetic" },
            { label: __("Curious", "chatgpt-assistant"), value: "curious" },
            { label: __("Disappointed", "chatgpt-assistant"), value: "disappointed" },
            { label: __("Encouraging", "chatgpt-assistant"), value: "encouraging" },
            { label: __("Optimistic", "chatgpt-assistant"), value: "optimistic" },
            { label: __("Surprised", "chatgpt-assistant"), value: "surprised" },
            { label: __("Worried", "chatgpt-assistant"), value: "worried" }
        ];
        var headingCountList = [
            { label: "1", value: 1 },
            { label: "2", value: 2 },
            { label: "3", value: 3 },
            { label: "4", value: 4 },
            { label: "5", value: 5 },
            { label: "6", value: 6 },
            { label: "7", value: 7 },
            { label: "8", value: 8 },
            { label: "9", value: 9 },
            { label: "10", value: 10 }
        ];
        var headingTagList = [
            { label: "h1", value: "h1" },
            { label: "h2", value: "h2" },
            { label: "h3", value: "h3" },
            { label: "h4", value: "h4" },
            { label: "h5", value: "h5" },
            { label: "h6", value: "h6" }
        ];
        var languageList = [
            { label: "English", value: "english" },
            { label: "Albanian", value: "albanian" },
            { label: "Arabic", value: "arabic" },
            { label: "Armenian", value: "armenian" },
            { label: "Awadhi", value: "awadhi" },
            { label: "Azerbaijani", value: "azerbaijani" },
            { label: "Bashkir", value: "bashkir" },
            { label: "Basque", value: "basque" },
            { label: "Belarusian", value: "belarusian" },
            { label: "Bengali", value: "bengali" },
            { label: "Bhojpuri", value: "bhojpuri" },
            { label: "Bosnian", value: "bosnian" },
            { label: "Brazilian Portuguese", value: "brazilian-portuguese" },
            { label: "Bulgarian", value: "bulgarian" },
            { label: "Cantonese (Yue)", value: "cantonese" },
            { label: "Catalan", value: "catalan" },
            { label: "Chhattisgarhi", value: "chhattisgarhi" },
            { label: "Chinese", value: "chinese" },
            { label: "Croatian", value: "croatian" },
            { label: "Czech", value: "czech" },
            { label: "Danish", value: "danish" },
            { label: "Dogri", value: "dogri" },
            { label: "Dutch", value: "dutch" },
            { label: "Estonian", value: "estonian" },
            { label: "Faroese", value: "faroese" },
            { label: "Finnish", value: "finnish" },
            { label: "French", value: "french" },
            { label: "Galician", value: "galician" },
            { label: "Georgian", value: "georgian" },
            { label: "German", value: "german" },
            { label: "Greek", value: "greek" },
            { label: "Gujarati", value: "gujarati" },
            { label: "Haryanvi", value: "haryanvi" },
            { label: "Hebrew", value: "hebrew" },
            { label: "Hindi", value: "hindi" },
            { label: "Hungarian", value: "hungarian" },
            { label: "Indonesian", value: "indonesian" },
            { label: "Irish", value: "irish" },
            { label: "Italian", value: "italian" },
            { label: "Japanese", value: "japanese" },
            { label: "Javanese", value: "javanese" },
            { label: "Kannada", value: "kannada" },
            { label: "Kashmiri", value: "kashmiri" },
            { label: "Kazakh", value: "kazakh" },
            { label: "Konkani", value: "konkani" },
            { label: "Korean", value: "korean" },
            { label: "Kyrgyz", value: "kyrgyz" },
            { label: "Latvian", value: "latvian" },
            { label: "Lithuanian", value: "lithuanian" },
            { label: "Macedonian", value: "macedonian" },
            { label: "Maithili", value: "maithili" },
            { label: "Malay", value: "malay" },
            { label: "Maltese", value: "maltese" },
            { label: "Mandarin", value: "mandarin" },
            { label: "Marathi", value: "marathi" },
            { label: "Marwari", value: "marwari" },
            { label: "Min Nan", value: "min-nan" },
            { label: "Moldovan", value: "moldovan" },
            { label: "Mongolian", value: "mongolian" },
            { label: "Montenegrin", value: "montenegrin" },
            { label: "Nepali", value: "nepali" },
            { label: "Norwegian", value: "norwegian" },
            { label: "Oriya", value: "oriya" },
            { label: "Pashto", value: "pashto" },
            { label: "Persian (Farsi)", value: "persian" },
            { label: "Polish", value: "polish" },
            { label: "Portuguese", value: "portuguese" },
            { label: "Punjabi", value: "punjabi" },
            { label: "Rajasthani", value: "rajasthani" },
            { label: "Romanian", value: "romanian" },
            { label: "Russian", value: "russian" },
            { label: "Sanskrit", value: "sanskrit" },
            { label: "Santali", value: "santali" },
            { label: "Serbian", value: "serbian" },
            { label: "Sindhi", value: "sindhi" },
            { label: "Sinhala", value: "sinhala" },
            { label: "Slovak", value: "slovak" },
            { label: "Slovene", value: "slovene" },
            { label: "Spanish", value: "spanish" },
            { label: "Swahili", value: "swahili" },
            { label: "Swedish", value: "swedish" },
            { label: "Tajik", value: "tajik" },
            { label: "Tamil", value: "tamil" },
            { label: "Tatar", value: "tatar" },
            { label: "Telugu", value: "telugu" },
            { label: "Thai", value: "thai" },
            { label: "Turkish", value: "turkish" },
            { label: "Turkmen", value: "turkmen" },
            { label: "Ukrainian", value: "ukrainian" },
            { label: "Urdu", value: "urdu" },
            { label: "Uzbek", value: "uzbek" },
            { label: "Vietnamese", value: "vietnamese" },
            { label: "Welsh", value: "welsh" },
            { label: "Wu", value: "wu" }
        ];        

        registerPlugin( 'ays-chatgpt-assistant-panel', { render: aysPanelGenerate } );
        registerPlugin( 'ays-chatgpt-assistant-sidebar', { render: aysSidebarGenerate } );

        function aysPanelGenerate () {
            return (
                el(
                    panel,
                    {
                        name: "chatgpt-assistant-custom-panel",
                        title:  "Ays ChatGPT Assistant",
                        className: "ays-chatgpt-assistant-panel-body",
                    },
                    el(
                        "button",
                        {
                            className: 'ays-chatgpt-assistant-panel-suggest-title'
                        },
                        loaderEl,
                        __("Suggest Title", "chatgpt-assistant")
                    )
                )
            );
        }
        function aysSidebarGenerate () {
            return (
                el(
                    sidebar,
                    {
                        name: "chatgpt-assistant-custom-sidebar",
                        title:  "Ays ChatGPT Assistant",
                        className: "ays-chatgpt-assistant-sidebar",
                        icon: iconEl
                    },
                    el(
                        select,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-select',
                            label: __('Model', "chatgpt_assistant"),
                            options: modelList,
                            onChange: function( option ) {
                                settings.chatModel = option;
                            },
                        },
                    ),
                    el(
                        select,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-select',
                            label: __('Style', "chatgpt_assistant"),
                            options: styleList,
                            onChange: function( option ) {
                                settings.chatStyle = option;
                            },
                        },
                    ),
                    el(
                        select,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-select',
                            label: __('Tone', "chatgpt_assistant"),
                            options: toneList,
                            onChange: function( val ) {
                                settings.chatTone = val;
                            }
                        },
                    ),
                    el(
                        select,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-select',
                            label: __('Language', "chatgpt_assistant"),
                            options: languageList,
                            onChange: function( val ) {
                                settings.chatLanguage = val;
                            }
                        },
                    ),
                    el(
                        number,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-number',
                            label: __('Word Count', "chatgpt_assistant"),
                            placeholder: settings.chatWordCount,
                            onChange: function (val) {
                                settings.chatWordCount = +val;
                            }
                        },
                    ),
                    el(
                        select,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-select',
                            label: __('Headings count', "chatgpt_assistant"),
                            options: headingCountList,
                            onChange: function( option ) {
                                settings.chatHeadingCount = option;
                            },
                        },
                    ),
                    el(
                        select,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-select',
                            label: __('Heading tag', "chatgpt_assistant"),
                            options: headingTagList,
                            onChange: function( option ) {
                                settings.chatHeadingTag = option;
                            },
                        },
                    ),
                    el(
                        divider,
                        {
                            margin: 5
                        }
                    ),
                    el(
                        range,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-range',
                            label: __("Temperature", "chatgpt_assistant"),
                            withInputField: false,
                            initialPosition: settings.chatTemperature,
                            min: 0,
                            max: 2,
                            step: 0.1,
                            onChange: function (val) {
                                settings.chatTemperature = val;
                            }
                        },
                    ),
                    el(
                        range,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-range',
                            label: "Top P",
                            withInputField: false,
                            initialPosition: settings.chatTopP ,
                            min: 0,
                            max: 1,
                            step: 0.01,
                            onChange: function (val) {
                                settings.chatTopP = val;
                            }
                        },
                    ),
                    el(
                        range,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-range',
                            label: __("Maximum tokens", "chatgpt_assistant"),
                            withInputField: false,
                            initialPosition: settings.chatMaxTokents,
                            min: 0,
                            max: 2048,
                            step: 1,
                            onChange: function (val) {
                                settings.chatMaxTokents = val;
                            }
                        },
                    ),
                    el(
                        range,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-range',
                            label: __("Frequency penalty", "chatgpt_assistant"),
                            withInputField: false,
                            initialPosition: settings.chatFrequencyPenalty,
                            min: -2,
                            max: 2,
                            step: 0.01,
                            onChange: function (val) {
                                settings.chatFrequencyPenalty = val;
                            }
                        },
                    ),
                    el(
                        range,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-range',
                            label: __("Presence penalty", "chatgpt_assistant"),
                            withInputField: false,
                            initialPosition: settings.chatPresencePenalty,
                            min: -2,
                            max: 2,
                            step: 0.01,
                            onChange: function (val) {
                                settings.chatPresencePenalty = val;
                            }
                        },
                    ),
                    el(
                        range,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-range',
                            label: __("Best of", "chatgpt_assistant"),
                            withInputField: false,
                            initialPosition: settings.chatBestOf,
                            min: 1,
                            max: 20,
                            step: 1,
                            onChange: function (val) {
                                settings.chatBestOf = val;
                            }
                        },
                    ),
                    el(
                        "div",
                        {
                            height: '20px'
                        }
                    ),
                    el(
                        button,
                        {
                            className: 'ays-chatgpt-assistant-sidebar-button',
                            variant: 'primary',
                            iconPosition: 'left',
                            onClick: function (e) {
                                swal({
                                    text: __('Generating content...', "chatgpt_assistant"),
                                    allowOutsideClick: false,
                                    showCancelButton: false,
                                    showCloseButton: false,
                                    allowEscapeKey: false,
                                    onBeforeOpen: () => {
                                        Swal.showLoading();
                                    },
                                });

                                var title = WPdata.select('core/editor').getEditedPostAttribute('title');
                                var prompt = `Create a compelling and well-researched article of at least `+settings.chatWordCount+` words on the topic of title: "`+title+`". Write in `+settings.chatLanguage+` language no matter in what language the title is. Structure the article with clear headings enclosed within the appropriate heading tags (e.g., <h1>, <h2>, etc.) and engaging subheadings. The number of headings should be exactly `+settings.chatHeadingCount+`, and the heading tag should be exactly <`+settings.chatHeadingTag+`>. Ensure that the content is `+settings.chatStyle+` and provides valuable insights to the reader. Incorporate relevant examples, case studies, and statistics to support your points. Organize your ideas using unordered lists with <ul> and <li> tags where appropriate. Conclude with a strong summary that ties together the key takeaways of the article. Remember to enclose headings in the specified heading tags to make parsing the content easier. Additionally, wrap even paragraphs in <p> tags for improved readability. Do not include the title in the content. Tone: `+settings.chatTone+`.`;

                                if (title.trim() === '') {
                                    swal.close();
                                    swal({
                                        type: 'error',
                                        title: __('Empty post title', "chatgpt_assistant"),
                                    });
                                } else {
                                    if (settings.apiType === 'gemini') {
                                        requestUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';
                                    } else {
                                        switch(settings.chatModel){
                                            case 'gpt-3.5-turbo':
                                            case 'gpt-3.5-turbo-16k':
                                            case 'gpt-4':
                                            case 'gpt-4-turbo-preview':
                                            case 'gpt-4o':
                                                requestUrl = "https://api.openai.com/v1/chat/completions";
                                                break;
                                            default:
                                                requestUrl = "https://api.openai.com/v1/completions";
                                                break;
                                        }
                                    }
                        
                                    var sendData = {
                                        requestUrl : requestUrl,
                                        prompt : prompt,
                                        chatConversation : [],
                                        url: window.AysChatGPTChatSettings.ajaxUrl,
                                        nonce: window.AysChatGPTChatSettings.nonce,
                                    }

                                    makeRequest(sendData , settings)
                                    .then(results => {
                                        var data = results.data;
                                        var checkError = (typeof data.error == "object" ) ? false : true;
                                        if(checkError){
                                            switch(settings.chatModel){
                                                case 'gpt-3.5-turbo':
                                                case 'gpt-3.5-turbo-16k':
                                                    var response = data.choices[0].message.content.replace(/^\n+/, '');
                                                    break;
                                                default:
                                                    var response = data.choices[0].text.replace(/^[^:]+:\s*/, '').replace(/^\n+/, '');
                                                    break;
                                            }

                                            var newBlock = WPblocks.createBlock( "core/html", { content: response });
                                            WPdata.dispatch( "core/editor" ).insertBlocks( newBlock );

                                            swal.close();
                                        } else {
                                            var errorMessage = '';
                                            if(data.error.type == "insufficient_quota"){
                                                errorMessage = " <a href='https://platform.openai.com/account/usage'> https://platform.openai.com/account/usage </a>";
                                            }
                                            
                                            swal.close();
                                            swal({
                                                type: 'error',
                                                title: __('Something went wrong', "chatgpt_assistant"),
                                                text: errorMessage
                                            });
                                        }
                                    });
                                }
                            }
                        },
                        __('Generate', "chatgpt_assistant")
                    ),
                    el(
                        'p',
                        {
                            className: 'ays-chatgpt-assistant-sidebar-hint-text'
                        },
                        __("Note: You must fill the post title before generating content.", "chatgpt_assistant")
                    )
                )
            );
        }

        $(document).on('click', 'button.ays-chatgpt-assistant-panel-suggest-title', function (e) {
            var loader = $(document).find('.ays-chatgpt-assistant-title-loader');
            loader.show();

            var title = WPdata.select('core/editor').getEditedPostAttribute('title');
            
            if (title.trim() === '') {
                loader.hide();
                swal({
                    type: 'error',
                    title: __('Empty post title', "chatgpt_assistant"),
                });
            } else {
                var prompt = `Suggest 5 meaningful alternative titles that convey the same meaning as the following title: '` + title + `'. Try to understand the meaning of the title, only after that generate alternatives. Do not include the original title. The language should the same as the title above. Present the titles in a JSON format as shown: '{"titles": ["title1", "title2", "title3", "title4", "title5"]}'. Only include the object of titles in the response, not a single symbol more.`;
                if (settings.readyK != '') {
                    switch(settings.chatModel){
                        case 'gpt-3.5-turbo':
                        case 'gpt-3.5-turbo-16k':
                            requestUrl = "https://api.openai.com/v1/chat/completions";
                            break;
                        default:
                            requestUrl = "https://api.openai.com/v1/completions";
                            break;
                    }
        
                    var sendData = {
                        requestUrl : requestUrl,
                        prompt : prompt,
                        chatConversation : [],
                        url: window.AysChatGPTChatSettings.ajaxUrl,
                        nonce: window.AysChatGPTChatSettings.nonce,
                    }

                    makeRequest(sendData , settings)
                    .then(results => {
                        var data = results.data;
                        var checkError = (typeof data.error == "object" ) ? false : true;
                        if(checkError){

                            switch(settings.chatModel){
                                case 'gpt-3.5-turbo':
                                case 'gpt-3.5-turbo-16k':
                                    var response = JSON.parse(data.choices[0].message.content.replace(/^\n+/, ''));
                                    break;
                                default:
                                    var response = JSON.parse(data.choices[0].text.replace(/^[^:]+:\s*/, '').replace(/^\n+/, ''));
                                    break;
                            }

                            if (response.titles.length > 0) {
                                var content = '<div class="ays-chatgpt-assistant-select-title-suggestion-container">';

                                response.titles.forEach(res => {
                                    if (res != '') {
                                        content += '<button class="ays-chatgpt-assistant-select-title-suggestion">' + res + '</button>';
                                    }
                                });

                                content += "</div>";

                                loader.hide();
                                swal({
                                    title: '<span class="ays-chatgpt-assistant-select-title-popup-title">' + "New title for '" + title + "'</span>",
                                    html: content,
                                    showCloseButton: true,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                            } else {
                                loader.hide();
                                swal({
                                    type: 'error',
                                    title: __('Something went wrong', "chatgpt_assistant"),
                                });
                            }
                        } else {
                            var errorMessage = '';
                            if(data.error.type == "insufficient_quota"){
                                errorMessage = " <a href='https://platform.openai.com/account/usage'> https://platform.openai.com/account/usage </a>";
                            }
                            
                            loader.hide();
                            swal({
                                type: 'error',
                                title: __('Something went wrong', "chatgpt_assistant"),
                                text: data.error.message + errorMessage
                            });
                        }
                    });
                } else {
                    loader.hide();
                    swal({
                        type: 'error',
                        title: __('Invalid OpenAI API Key', "chatgpt_assistant"),
                        text: __('Please connect to OpenAI first', "chatgpt_assistant")
                    });
                }
            }
        });
        $(document).on('click', '.ays-chatgpt-assistant-select-title-suggestion', function () {
            swal.close();
            WPdata.dispatch( 'core/editor' ).editPost( { title: $(this).text() } )
        });
        
        function configureSettings () {
            var settings = {};
            var globalSettings = window.AysChatGPTChatSettings;

            // var key = globalSettings.translations.ka ? atob(globalSettings.translations.ka) : '';
            // var index = key.indexOf("chgafr");
            // settings.readyK = (index !== -1) ? key.substring(0, index) : '';

            settings.chatModel = globalSettings.chatModel ? globalSettings.chatModel : 'gpt-3.5-turbo-16k';
            settings.chatTemperature = globalSettings.chatTemprature ? +globalSettings.chatTemprature : 0.7;
            settings.chatTopP        = globalSettings.chatTopP ? +globalSettings.chatTopP : 1;
            settings.chatMaxTokents  = globalSettings.chatMaxTokents ? +globalSettings.chatMaxTokents : 1500;
            settings.chatFrequencyPenalty = globalSettings.chatFrequencyPenalty ? +globalSettings.chatFrequencyPenalty : 0.01;
            settings.chatPresencePenalty  = globalSettings.chatPresencePenalty ? +globalSettings.chatPresencePenalty : 0.01;
            settings.chatBestOf = globalSettings.chatBestOf ? +globalSettings.chatBestOf : 1;
            settings.chatModel = AysChatGPTChatSettings.chatModel ? AysChatGPTChatSettings.chatModel : 'gpt-3.5-turbo-16k';
            settings.chatLanguage = AysChatGPTChatSettings.chatLanguage ? AysChatGPTChatSettings.chatLanguage : 'en';   
            settings.chatHeadingCount = 1
            settings.chatHeadingTag = 'h1';
            settings.chatWordCount = 500;
            settings.chatStyle = 'infor';
            settings.chatTone = 'formal';

            return settings;
        }
    });

})(jQuery);