import { gsap } from "gsap";

gsap.set("#main", { y: 100, opacity: 0 })
gsap.to("#main", { y: 0, opacity: 1, duration: .5, ease: "expo.inOut" })

